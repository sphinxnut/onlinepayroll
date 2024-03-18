<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once "conn.php";

    // Retrieve data from the form
    $employeeId = $_POST['employee_id'];
    $date = $_POST['date'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $rate = $_POST['rate'];

    $total_hours = $hours + ($minutes / 60);


    $sql = "INSERT INTO overtime (employee_id, hours, rate, date_overtime) 
            VALUES ('$employeeId', '$total_hours', '$rate', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Overtime request submitted successfully."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
    }

    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
