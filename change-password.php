<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Change Password</title>

    
    
</head>
<body>
    <?php

    //learn from w3schools.com
    //Unset all the server side variables

    session_start();

    $_SESSION["user"]="";
    
    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');

    $_SESSION["date"]=$date;
    

    //import database
    include("connection.php");

    if($_POST){

        $email=$_SESSION['email'];
        $usertype=$_SESSION['usertype'];
        
        $error='<label for="promter" class="form-label"></label>';

        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];

        if($password==$cpassword){

            if($usertype=='p'){
                $database->query("update patient set ppassword='$password' where pemail='$email'");
            }else if($usertype=='d'){
                $database->query("update doctor set docpassword='$password' where docemail='$email'");
            }

            $error='<label for="promter" class="form-label">Password changed successfully</label>';
            header("refresh:2;url=login.php");
        }else{
            $error='<label for="promter" class="form-label">Password does not match</label>';
        }
        
    }else{
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>





    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">
                        Change Password
                    </p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">
                        Please enter the OTP sent to your email address
                        <br />
                        Email Address: <?= $_SESSION['email'] ?>
                        <br>
                        User Type: <?= $_SESSION['usertype'] ?>
                    </p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="password" class="form-label">Password </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="password" name="password" class="input-text" placeholder="Enter Password" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="cpassword" class="form-label">Confirm Password </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="password" name="cpassword" class="input-text" placeholder="Enter Password" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="submit" value="Reset" class="login-btn btn-primary btn">
                </td>
            </tr>

            <tr>
                <td><br>
                <?= $error ?>
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <a href="login.php" class="hover-link1 non-style-link">
                        <p class="sub-text">
                            Back to Login
                        </p>
                    </a>
                </td>
            </tr>
                        
                        
    
                        
                    </form>
        </table>

    </div>
</center>
</body>
</html>