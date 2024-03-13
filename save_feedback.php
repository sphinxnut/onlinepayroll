<?php
session_start();
if (!isset($_SESSION["username"])) {
    // Redirect back to login page if not logged in
    header("Location: login.php");
    exit();
}

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    $feedbackMessage = $_POST["message"];
    $username = $_SESSION["username"];

    // Update the feedback message for the employee in the database
    $sql = "UPDATE employees SET feedback_message = '$feedbackMessage' WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        // Set the success message as a URL parameter
        header("Location: feedback_form.php?message=Feedback%20sent%20successfully!");
        exit();
    } else {
        $_SESSION['message'] = "Error: Feedback not sent. Please try again later.";
        header("Location: feedback_form.php");
        exit();
    }
} else {
    // If the request method is not POST or message parameter is not set
    $_SESSION['message'] = "Error: Invalid request.";
    header("Location: feedback_form.php");
    exit();
}
