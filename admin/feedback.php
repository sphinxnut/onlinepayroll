<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Feedback List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Feedback</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <?php
                                if (isset($_SESSION['error'])) {
                                    echo "<div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                                        " . $_SESSION['error'] . "
                                        </div>";
                                    unset($_SESSION['error']);
                                }
                                if (isset($_SESSION['success'])) {
                                    echo "<div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                                        " . $_SESSION['success'] . "
                                        </div>";
                                    unset($_SESSION['success']);
                                }
                                ?>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered">
                                        <thead>
                                            <th>Employee ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Feedback Message</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT employee_id, firstname, lastname, username, feedback_message FROM employees";
                                            $query = $conn->query($sql);
                                            while ($row = $query->fetch_assoc()) {

                                                echo "<td>" . $row['employee_id'] . "</td>";
                                                echo "<td>" . $row['firstname'] . "</td>";
                                                echo "<td>" . $row['lastname'] . "</td>";
                                                echo "<td>" . $row['feedback_message'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        
        </div>
                <?php include 'includes/footer.php'; ?>
    </div>
  <?php include 'includes/scripts.php'; ?>
</body>

</html>