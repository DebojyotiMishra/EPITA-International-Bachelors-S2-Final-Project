<?php
session_start();
include 'db_conn.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST['email'])) {
        header('Location: ../index.php?error=Email is required');
        exit();
    } else if (empty($_POST['password'])) {
        header('Location: ../index.php?error=Password is required');
        exit();
    } else {
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        $sql = "SELECT * FROM admins WHERE email='$email' AND password='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            if ($row = mysqli_fetch_assoc($result)) {
                if ($row['email'] === $email && $row['password'] === $password) {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['id'] = $row['id'];

                    header('Location: ../pages/welcome.php');
                    exit();
                } else {
                    header('Location: ../index.php?error=Incorrect Email or Password');
                    exit();
                }
            }
        } else {
            header('Location: ../index.php?error=Incorrect Email or Password');
            exit();
        }
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
} else {
    header('Location: ../index.php');
    exit();
}

?>