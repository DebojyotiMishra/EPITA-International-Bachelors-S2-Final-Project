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
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';

// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Retrieve student_contact_ref before editing the student record
    $stmt = $conn->prepare("SELECT student_contact_ref FROM students WHERE student_epita_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($contact_ref);
    $stmt->fetch();
    $stmt->close();

    if ($contact_ref) {
        // Prepare SQL statement for contacts table
        $stmt2 = $conn->prepare("UPDATE contacts SET contact_first_name=?, contact_last_name=? WHERE contact_email=?");
        $stmt2->bind_param("sss", $first_name, $last_name, $contact_ref);

        // Execute SQL statement for contacts table
        if ($stmt2->execute()) {
            echo "Contact record updated successfully<br>";
        } else {
            echo "Error updating contact record: " . $stmt2->error . "<br>";
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
