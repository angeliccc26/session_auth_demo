<?php
include 'db.php';

if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
$success= '';

if(isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $result = mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')");
        if($result) {
            $success = "Registration successful. You can now <a href='index.php'>login</a>.";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}

?>