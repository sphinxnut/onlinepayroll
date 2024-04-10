<?php
// Include the database connection file
include 'includes/conn.php';
include_once("./PHPMailer.php");
include_once("./SMTP.php");
include_once("./Exception.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Instantiate PHPMailer
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update the status in the database
    $sql = "UPDATE overtime SET status = '$status' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {

        $employeeEmailQuery = "SELECT e.email FROM employees e JOIN overtime o ON e.employee_id = o.employee_id WHERE o.id = '$id'";
        $result = mysqli_query($conn, $employeeEmailQuery);
        $row = mysqli_fetch_assoc($result);
        $employeeEmail = $row['email'];

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ojt.rms.group.4@gmail.com';                     //SMTP username
        $mail->Password   = 'hbpezpowjedwoctl';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                 // TCP port to connect to

        // Recipients
        $mail->setFrom('ojt.rms.group.4@gmail.com', 'Cafe Cerveza Admin');
        $mail->addAddress($employeeEmail); // Add a recipient


        $mail->Subject = 'Overtime Status Update';
        $mail->isHTML(true);
        $statusColor = ($status === 'Rejected') ? 'red' : 'green';
        $mail->Body = '
    <html>
    <head>
        <title>Overtime Status Update</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                color: #333;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #007bff;
            }
            p {
                font-size: 16px;
                line-height: 1.5;
            }
            .status {
                font-weight: bold;
                color: ' . $statusColor . ';
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Overtime Status Update</h1>
            <p>Your overtime request has been <span class="status">' . $status . '</span>.</p>
        </div>
    </body>
    </html>
';

        if ($mail->send()) {
            // Redirect back to the original page
            header("Location: overtime_request.php");
            exit(); // Ensure no further code execution after redirection
        } else {
            echo "message cannot be sent";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

mysqli_close($conn);
