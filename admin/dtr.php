<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    DTR Detailed
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Attendance</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">

                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <th class="hidden"></th>

                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Total Hours</th>
                                        <th>Overtime</th>
                                        <th>Absent</th>
                                    </thead>
                                    <tbody>

                                        <?php
                                        include './includes/attendance_modal.php';
                                        if (isset($_POST['dtrSubmit'])) {
                                            $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";
                                            $query = $conn->query($sql);
                                            while ($row = $query->fetch_assoc()) {
                                                $status = ($row['status']) ? '<span class="label label-warning pull-right">ontime</span>' : '<span class="label label-danger pull-right">late</span>';
                                                echo "
                                        <tr>
                                            <td class='hidden'></td>
                                            <td>" . $row['firstname'] . $row['lastname'] . "</td>
                                            <td>" . date('M d, Y', strtotime($row['date'])) . "</td>
                                            <td>" . date('h:i A', strtotime($row['time_in'])) . $status . "</td>
                                            <td>" . date('h:i A', strtotime($row['time_out'])) . "</td>
                                            <td>" . $row['num_hr'] . "</td>

                                        </tr>
                                        ";
                                            }
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
        <script>
            function getRow(id) {
                $.ajax({
                    type: 'POST',
                    url: 'attendance_row.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#datepicker_edit').val(response.date);
                        $('#attendance_date').html(response.date);
                        $('#edit_time_in').val(response.time_in);
                        $('#edit_time_out').val(response.time_out);
                        $('#attid').val(response.attid);
                        $('#employee_name').html(response.firstname + ' ' + response.lastname);
                        $('#del_attid').val(response.attid);
                        $('#del_employee_name').html(response.firstname + ' ' + response.lastname);
                        $('#dtr_name').html(response.firstname + ' ' + response.lastname);
                        $("#datepicker_dtr1").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).val(response.date);
                        $("#datepicker_dtr2").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).val(response.date);
                    }
                });
            }
        </script>

</body>

</html>