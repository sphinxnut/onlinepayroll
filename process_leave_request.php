    <?php
    // process_shift_request.php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include database connection
        include_once "conn.php";

        // Retrieve data from the form
        $employeeId = $_POST['employee_id'];
        $reason = $_POST['reason'];
        $leaveDate = $_POST['leaveDate'];


        // Insert the shifting request into the database
        $sql = "INSERT INTO leave_requests (employee_id, reason, leave_date) VALUES ('$employeeId', '$reason', '$leaveDate')";

        if ($conn->query($sql) === TRUE) {
            // Shifting request successfully submitted
            echo json_encode(array("success" => true, "message" => "Leave request submitted successfully."));
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
