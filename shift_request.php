<?php
session_start();
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift Request</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
    <style>
        body {
            background-color: #141414;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h3 class="text-center"><img src="images/1.png" class="img-fluid" alt="Logo"></h3>
                <div class="text-center">
                    <p class="text-white" id="date"></p>
                    <p class="text-white" id="time"></p>
                </div>
                <div class="login-box mt-4">
                    <div class="login-box-body">
                        <h4 class="login-box-msg">Shift Request for
                            <?php
                            if (isset($_GET['employee_id'])) {
                                $employeeId = $_GET['employee_id'];
                                include 'conn.php'; // Include your database connection code
                                $sql = "SELECT firstname, lastname FROM employees WHERE employee_id = '$employeeId'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo $row['firstname'] . ' ' . $row['lastname'];
                                } else {
                                    echo "Employee Not Found";
                                }
                            } else {
                                echo "Employee ID Not Provided";
                            }
                            ?>
                        </h4>
                        <form method="post" action="process_shift_request.php">
                            <input type="hidden" name="employee_id" value="<?php echo $employeeId; ?>">

                            <div class="form-group">
                                <label for="requested_shift">Requested Shift:</label>
                                <select id="requested_shift" name="requested_shift" class="form-control" required>
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="text" id="datepicker" name="date" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="time_from">Time From:</label>
                                <input type="text" id="time_from" name="time_from" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="time_to">Time To:</label>
                                <input type="text" id="time_to" name="time_to" class="form-control" autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
                            <a href="index.php" class="btn btn-primary btn-block">Back</a>

                        </form>
                    </div>
                </div>
                <!-- SUCCESS ALERT -->
                <div class="alert alert-success alert-dismissible mt-3 text-center" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
                </div>
                <div class="alert alert-danger alert-dismissible mt-3 text-center" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            // Timepicker initialization
            $('#time_from, #time_to').timepicker({
                minuteStep: 1,
                showSeconds: false,
                showMeridian: true, // Show AM/PM indicators
                defaultTime: false
            });
            $('form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Submit form data using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'process_shift_request.php',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Show success message in alert
                            $('.alert-success .message').text(response.message);
                            $('.alert-success').show();
                        } else {
                            // Show error message in alert
                            $('.alert-danger .message').text(response.message);
                            $('.alert-danger').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>