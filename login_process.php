<?php
session_start();
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($pass == $row['password']) {
            $role = $row['role'];
            $_SESSION['username'] = $user;
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: user_dashboard.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Incorrect username or password!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "You are not a registered user!";
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>