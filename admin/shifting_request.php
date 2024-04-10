<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    .btn-group form {
        display: inline-block;
    }
</style>

<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Shifting Request </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Employees</li>
                    <li class="active">Shifting Request</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">

                            </div>
                            <div class="box-body">
                                <!-- Add the shifting request table here -->
                                <table id="shifting_request_table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Full Name</th>
                                            <th>Requested Shift</th>
                                            <th>Request Date</th>
                                            <th>Time From</th>
                                            <th>Time To</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch data from the database and populate the table
                                        // Modify this part according to your database schema and data retrieval logic
                                        $sql = "SELECT shift_requests.*, employees.firstname, employees.lastname 
        FROM shift_requests 
        LEFT JOIN employees ON shift_requests.employee_id = employees.employee_id ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["employee_id"] . "</td>";
                                                echo "<td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>";
                                                echo "<td>" . $row["requested_shift"] . "</td>";
                                                echo "<td>" . $row["request_date"] . "</td>";
                                                echo "<td>" . $row["time_from"] . "</td>";
                                                echo "<td>" . $row["time_to"] . "</td>";
                                                echo "<td>" . $row["status"] . "</td>";
                                                echo "<td>";

                                                if ($row["status"] === 'Pending') {
                                                    echo "<div class='btn-group'>";
                                                    echo "<form action='update_shifting_status.php' method='post'>";
                                                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                                    echo "<input type='hidden' name='status' value='Approved'>";
                                                    echo "<button type='submit' class='btn btn-success'>Approve</button>";
                                                    echo "</form>";

                                                    echo "<form action='update_shifting_status.php' method='post'>";
                                                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                                    echo "<input type='hidden' name='status' value='Rejected'>";
                                                    echo "<button type='submit' class='btn btn-danger'>Cancel</button>";
                                                    echo "</form>";
                                                    echo "</div>";
                                                } else {
                                                    echo "Completed";
                                                }
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>No shifting requests found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/attendance_modal.php'; ?>
    </div>
    <?php include 'includes/scripts.php'; ?>

    <script>
        /*      function approveRequest(id) {
            // Send AJAX request to update the status to 'Approved'
            $.ajax({
                type: 'POST',
                url: 'update_shifting_status.php',
                data: {
                    id: id,
                    status: 'Approved'
                },
                success: function(response) {
                    // Reload the page or update the table as needed
                    location.reload();
                }
            });
        }

        function cancelRequest(id) {
            // Send AJAX request to update the status to 'Rejected'
            $.ajax({
                type: 'POST',
                url: 'update_shifting_status.php',
                data: {
                    id: id,
                    status: 'Rejected'
                },
                success: function(response) {
                    // Reload the page or update the table as needed
                    location.reload();
                }
            });
        } */


        function approveRequest(id) {
            document.getElementById('approveId').value = id;
            document.getElementById('approveForm').submit();
        }

        // JavaScript function to set ID and submit form for cancellation
        function cancelRequest(id) {
            document.getElementById('cancelId').value = id;
            document.getElementById('cancelForm').submit();
        }
    </script>
</body>

</html>