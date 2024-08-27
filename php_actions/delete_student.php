<?php
session_start();
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "s2");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get student email from POST parameter
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Retrieve student_contact_ref before deleting the student record
    $stmt = $conn->prepare("SELECT student_contact_ref FROM students WHERE student_epita_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($contact_ref);
    $stmt->fetch();
    $stmt->close();

    if ($contact_ref) {
        // Prepare SQL statement for students table
        $stmt1 = $conn->prepare("DELETE FROM students WHERE student_epita_email = ?");
        $stmt1->bind_param("s", $email);

        // Execute SQL statement for students table
        if ($stmt1->execute()) {
            echo "Student record deleted successfully<br>";
        } else {
            echo "Error deleting student record: " . $stmt1->error . "<br>";
        }

        // Close statement for students table
        $stmt1->close();

        // Prepare SQL statement for contacts table
        $stmt2 = $conn->prepare("DELETE FROM contacts WHERE contact_email = ?");
        $stmt2->bind_param("s", $contact_ref);

        // Execute SQL statement for contacts table
        if ($stmt2->execute()) {
            echo "Contact record deleted successfully<br>";
        } else {
            echo "Error deleting contact record: " . $stmt2->error . "<br>";
        }

        // Close statement for contacts table
        $stmt2->close();
    } else {
        echo "No contact reference found for the given student email<br>";
    }
} else {
    echo "Invalid email format";
}

$conn->close();
?>
