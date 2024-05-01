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
                    Best Employee Attendance
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Attendance</li>
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
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <th class="hidden"></th>

                                        <th>Rank</th>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Attendance Count</th>
                                        <th>Best Attendance GIF</th>

                                    </thead>
                                    <tbody>
                                        <?php

                                        function generateTrophyURL1()
                                        {
                                            return "https://github-profile-trophy.vercel.app/?username=uhrzel&title=Stars";
                                        }
                                        function generateTrophyURL2()
                                        {
                                            return "https://github-profile-trophy.vercel.app/?username=reydelshit&title=Stars";
                                        }
                                        function generateTrophyURL3()
                                        {
                                            return "https://github-profile-trophy.vercel.app/?username=aynjel&title=Stars";
                                        }

                                        $sql = "SELECT
                            e.employee_id,
                            e.firstname,
                            e.lastname,
                            COUNT(a.id) AS attendance_count
                        FROM 
                            employees e
                        LEFT JOIN
                            attendance a ON e.id = a.employee_id 
                            AND MONTH(a.date) = MONTH(CURRENT_DATE()) 
                            AND YEAR(a.date) = YEAR(CURRENT_DATE()) 
                            AND a.status = 1
                        GROUP BY 
                            e.employee_id
                        ORDER BY 
                            attendance_count DESC
                        LIMIT 3";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            $rank = 1;
                                            // Output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo '<td>' . $rank . '</td>';
                                                echo '<td>' . $row["employee_id"] . '</td>';
                                                echo '<td>' . $row["firstname"] . '</td>';
                                                echo '<td>' . $row["lastname"] . '</td>';
                                                echo '<td>' . $row["attendance_count"] . '</td>';
                                                if ($rank === 1) {
                                                    $trophyURL1 = generateTrophyURL1($row["attendance_count"]);
                                                    $trophyURL2 = generateTrophyURL2($row["attendance_count"]);
                                                    $trophyURL3 = generateTrophyURL3($row["attendance_count"]);
                                                    echo '<td><div style="width:100%;height:0;padding-bottom:56%;position:relative;"><img src="' . $trophyURL1 . '" style="position:absolute"></img></div></td>';
                                                } else if ($rank === 2) {
                                                    echo '<td><div style="width:100%;height:0;padding-bottom:56%;position:relative;"><img src="' . $trophyURL2 . '"  style="position:absolute"></img></div></td>';
                                                } else if ($rank === 3) {
                                                    echo '<td><div style="width:100%;height:0;padding-bottom:56%;position:relative;"><img src="' . $trophyURL3 . '"style="position:absolute"></img></div></td>';
                                                } else {
                                                    echo '<td></td>';
                                                }

                                                echo "</tr>";
                                                $rank++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No data found</td></tr>";
                                        }
                                        $conn->close();
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
        /*      $(function() {
            $('.edit').click(function(e) {
                e.preventDefault();
                $('#edit').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $('.delete').click(function(e) {
                e.preventDefault();
                $('#delete').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $('.dtr').click(function(e) {


                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: 'dtr_row.php',
                    data: {
                        id: id
                    },

                    success: function(response) {

                        $('#dtr').html(response);
                    }
                });
                $('#mod').modal('show');
            });
        }); */

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