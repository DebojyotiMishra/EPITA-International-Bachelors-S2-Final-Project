<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentEmail = $_POST['studentEmail'] ?? '';
    $courseCode = $_POST['courseCode'] ?? '';
    $courseRev = $_POST['courseRev'] ?? '';
    $examType = $_POST['examType'] ?? '';
    $newGrade = $_POST['newGrade'] ?? '';

    if (!empty($studentEmail) && !empty($courseCode) && !empty($courseRev) && !empty($examType) && is_numeric($newGrade)) {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "s2");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to update the grade
        $stmt = $conn->prepare("
            UPDATE grades
            SET grade_score = ?
            WHERE grade_student_epita_email_ref = ? 
            AND grade_course_code_ref = ? 
            AND grade_course_rev_ref = ? 
            AND grade_exam_type_ref = ?
        ");
        $stmt->bind_param("dssss", $newGrade, $studentEmail, $courseCode, $courseRev, $examType);

        if ($stmt->execute()) {
            echo "Grade updated successfully.";
        } else {
            echo "Error updating grade: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request method.";
}
?>
