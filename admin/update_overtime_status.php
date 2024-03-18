<?php
// Include the database connection file
include 'includes/conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $sql = "UPDATE overtime SET status = '$status' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        // Status updated successfully
        echo "Status updated successfully";
    } else {

        echo "Error: " . mysqli_error($conn);
    }
} else {

    echo "Invalid request";
}


mysqli_close($conn);
