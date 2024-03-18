<?php
session_start();
if (!isset($_SESSION["username"])) {
    // Redirect back to login page if not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #141414;
            color: white;
        }

        .form-container {
            margin-top: 50px;
            width: 400px;
            margin: auto;
        }

        h2,
        h3 {
            text-align: center;
        }

        .form-label {
            color: white;
        }

        .btn {
            margin-top: 10px;
        }

        .logout-btn {
            margin-top: 20px;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="card-page">
        <h1>CAFE CERVEZA ATTENDANCE AND PAYROLL SYSTEM</h1> <br>

        <h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>
        <div class="form-container">
            <div class="card">
                <div class="card-body">
                    <h3>Feedback Form</h3>
                    <!-- Display success message if available -->
                    <?php if (isset($_GET['message'])) : ?>
                        <div class="alert alert-success text-center"><?php echo $_GET['message']; ?></div>
                    <?php endif; ?>
                    <form action="save_feedback.php" method="POST">
                        <div class="mb-3">
                            <label for="feedbackMessage" class="form-label">Feedback Message:</label>
                            <textarea class="form-control" required id="feedbackMessage" name="message" rows="4" placeholder="Type your feedback here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                    </form>
                    <a href="logout.php" class="btn btn-secondary logout-btn">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>