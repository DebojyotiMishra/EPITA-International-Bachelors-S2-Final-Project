<?php
session_start();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Unknown error occurred'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "s2");

    if ($conn->connect_error) {
        $response['message'] = "Connection failed: " . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $birthdate = $_POST['birthdate'];
    $status = $_SESSION['status'];
    $period = $_SESSION['period'];
    $year = $_SESSION['year'];
    $program = $_SESSION['program'];

    // Insert into contacts table
    $stmt1 = $conn->prepare("INSERT INTO contacts (contact_email, contact_first_name, contact_last_name, contact_address, contact_city, contact_country, contact_birthdate) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssssss", $contact, $firstName, $lastName, $address, $city, $country, $birthdate);

    if (!$stmt1->execute()) {
        $response['message'] = "Error: " . $stmt1->error;
        echo json_encode($response);
        $stmt1->close();
        $conn->close();
        exit();
    }

    $stmt1->close();

    // Insert into students table
    $stmt2 = $conn->prepare("INSERT INTO students (student_epita_email, student_contact_ref, student_enrollment_status, student_population_period_ref, student_population_year_ref, student_population_code_ref) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("ssssss", $email, $contact, $status, $period, $year, $program);

    if ($stmt2->execute()) {
        $response['success'] = true;
        $response['message'] = 'New student added successfully';

        $stmt2->close();

        // Fetch courses related to the student's program from the programs table
        $query = "SELECT program_course_code_ref, program_course_rev_ref 
                  FROM programs 
                  WHERE program_assignment = ?";
        $stmt3 = $conn->prepare($query);
        $stmt3->bind_param("s", $program);
        $stmt3->execute();
        $result = $stmt3->get_result();

        $coursesForProgram = [];
        while ($row = $result->fetch_assoc()) {
            $coursesForProgram[] = [
                'course_code' => $row['program_course_code_ref'],
                'course_rev' => $row['program_course_rev_ref']
            ];
        }
        $stmt3->close();

        if (!empty($coursesForProgram)) {
            // Fetch exam types for the program's courses from the grades table
            $insertStmt = $conn->prepare("INSERT INTO grades (grade_student_epita_email_ref, grade_course_code_ref, grade_course_rev_ref, grade_exam_type_ref, grade_score) VALUES (?, ?, ?, ?, NULL)");

            foreach ($coursesForProgram as $course) {
                $courseCode = $course['course_code'];
                $courseRev = $course['course_rev'];

                $examTypeQuery = "SELECT DISTINCT grade_exam_type_ref 
                                  FROM grades 
                                  WHERE grade_course_code_ref = ? 
                                  AND grade_course_rev_ref = ?";
                $stmt4 = $conn->prepare($examTypeQuery);
                $stmt4->bind_param("ss", $courseCode, $courseRev);
                $stmt4->execute();
                $examTypesResult = $stmt4->get_result();

                while ($examTypeRow = $examTypesResult->fetch_assoc()) {
                    $examType = $examTypeRow['grade_exam_type_ref'];

                    $insertStmt->bind_param("ssss", $email, $courseCode, $courseRev, $examType);
                    $insertStmt->execute();
                }

                $stmt4->close();
            }

            $insertStmt->close();
        } else {
            $response['message'] = "No courses found for the program.";
        }
    } else {
        $response['message'] = "Error: " . $stmt2->error;
    }

    $conn->close();
}

echo json_encode($response);
