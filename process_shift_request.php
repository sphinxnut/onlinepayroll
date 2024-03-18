    <?php
    // process_shift_request.php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include database connection
        include_once "conn.php";

        // Retrieve data from the form
        $employeeId = $_POST['employee_id'];
        $requestedShift = $_POST['requested_shift'];
        $timeFrom = $_POST['time_from'];
        $timeTo = $_POST['time_to'];
        $requestDate = $_POST['date'];

        // Insert the shifting request into the database
        $sql = "INSERT INTO shift_requests (employee_id, requested_shift,request_date, time_from, time_to) VALUES ('$employeeId', '$requestedShift', '$requestDate', '$timeFrom', '$timeTo')";

        if ($conn->query($sql) === TRUE) {
            // Shifting request successfully submitted
            echo json_encode(array("success" => true, "message" => "Shifting request submitted successfully."));
        } else {
            // Error occurred while submitting the shifting request
            echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
        }

        // Close database connection
        $conn->close();
    } else {
        // Invalid request method
        echo json_encode(array("success" => false, "message" => "Invalid request method."));
    }
