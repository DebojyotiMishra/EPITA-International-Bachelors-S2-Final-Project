<?php
header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => 'Unknown error'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect POST data
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $course_rev = $_POST['course_rev'];
    $duration = $_POST['duration'];
    $course_last_rev = $_POST['course_last_rev'];
    $course_description = $_POST['course_description'];
    $program_assignment = $_POST['program_assignment'];
    $teacher_email = $_POST['teacher_name'];

    // Connect to MySQL
    $conn = new mysqli("localhost", "root", "", "s2");

    // Check connection
    if ($conn->connect_error) {
        $response['message'] = "Connection failed: " . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert the course into the 'courses' table
        $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, course_rev, duration, course_last_rev, course_description, teacher_epita_email_ref) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiiss", $course_id, $course_name, $course_rev, $duration, $course_last_rev, $course_description, $teacher_email);

        if (!$stmt->execute()) {
            throw new Exception("Failed to insert into 'courses' table: " . $stmt->error);
        }

        // Insert into the 'programs' table
        $stmt = $conn->prepare("INSERT INTO programs (program_course_code_ref, program_course_rev_ref, program_assignment) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $course_id, $course_rev, $program_assignment);

        if (!$stmt->execute()) {
            throw new Exception("Failed to insert into 'programs' table: " . $stmt->error);
        }

        // Retrieve the list of students in the program
        $stmt = $conn->prepare("SELECT student_epita_email FROM students WHERE student_population_code_ref = ?");
        $stmt->bind_param("s", $program_assignment);

        if (!$stmt->execute()) {
            throw new Exception("Failed to retrieve students: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $students = $result->fetch_all(MYSQLI_ASSOC);

        // Insert grades with NULL value for each student for the new course
        $stmt = $conn->prepare("INSERT INTO grades (grade_student_epita_email_ref, grade_course_code_ref, grade_course_rev_ref, grade_exam_type_ref, grade_score) VALUES (?, ?, ?, 'Exam', NULL)");

        foreach ($students as $student) {
            $stmt->bind_param("ssi", $student['student_epita_email'], $course_id, $course_rev);
            if (!$stmt->execute()) {
                throw new Exception("Failed to insert into 'grades' table: " . $stmt->error);
            }
        }

        // Commit the transaction
        $conn->commit();
        $response['success'] = true;
        $response['message'] = "Course and grades added successfully!";
    } catch (Exception $e) {
        // Rollback the transaction if something went wrong
        $conn->rollback();
        $response['message'] = "An error occurred while adding the course. Details: " . $e->getMessage();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    $response['message'] = "Invalid request method.";
}

echo json_encode($response);
