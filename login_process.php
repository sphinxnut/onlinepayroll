<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM employees WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $_SESSION["username"] = $username;
        header("Location: feedback_form.php");
        exit();
    } else {
        // Login failed, redirect back to login page with error message
        $_SESSION["login_error"] = "Invalid username or password";
        header("Location: login.php");
        exit();
    }
} else {
    // Invalid request, redirect back to login page
    header("Location: login.php");
    exit();
}
