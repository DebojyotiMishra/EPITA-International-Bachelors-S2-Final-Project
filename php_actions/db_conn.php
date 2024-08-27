<?php
// database connection
$server = "localhost";
$user = "root";
$password = "";
$db = "s2";

$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    echo "Connection failed!";
    die("Connection failed: " . mysqli_connect_error());
} 
?>