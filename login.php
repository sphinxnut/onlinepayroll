<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body.login-page {
            background-color: #141414;
        }

        .login-box {
            margin-top: 50px;
            width: 400px;
            margin: auto;
        }

        .login-logo b {
            font-size: 30px;
            font-weight: bold;
            color: whitesmoke;
        }

        h1 {
            text-align: center;
            color: white !important;
            margin-top: 50px;
        }
    </style>
</head>

<body class="login-page">
    <h1>CAFE CERVEZA ATTENDANCE AND PAYROLL SYSTEM</h1> <br>
    <div class="login-box">
        <div class="login-logo text-center">
            <b>Employee Login</b>
            <br>
            <br>
            <br>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="card-text text-center">Sign in to send you feedback</p>
                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in me-2"></i>Sign In</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_SESSION['login_error'])) {
                    echo "<div class='alert alert-danger text-center mt-3' role='alert'>" . $_SESSION['login_error'] . "</div>";
                    unset($_SESSION['login_error']);
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>