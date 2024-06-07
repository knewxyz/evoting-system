<?php
session_start();
include_once "db_connection.php";

// Collect and sanitize input
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gradelevel = $_POST['gradelevel'];
$gender = $_POST['gender'];
$username = $_POST['username'];
$password = $_POST['password']; // Plain-text password

// Check for empty fields
if (empty($firstname) || empty($lastname) || empty($gradelevel) || empty($gender) || empty($username) || empty($password)) {
    echo "All fields are required. Please fill out the form completely.";
    exit(); // Stop script execution
}

// Check if the username already exists
$sql_check = "SELECT username FROM users WHERE username=?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo "Username '$username' is already taken. Please choose a different username.";
    exit(); // Stop script execution
}

// Insert new user into the database
$sql_insert = "INSERT INTO users (firstname, lastname, gradelevel, gender, username, password) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ssisss", $firstname, $lastname, $gradelevel, $gender, $username, $password);

if ($stmt_insert->execute()) {
    // Redirect to login page after successful registration
    header("Location: login.php?registered=1");
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

$stmt_insert->close();
$conn->close();
?>
