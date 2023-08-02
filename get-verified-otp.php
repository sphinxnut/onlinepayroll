<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Verify OTP</title>

    
    
</head>
<body>
    <?php

    //learn from w3schools.com
    //Unset all the server side variables

    session_start();

    $_SESSION["user"]="";
    $_SESSION["usertype"]="";
    
    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');

    $_SESSION["date"]=$date;
    

    //import database
    include("connection.php");

    



    if($_POST){

        $email=$_SESSION['email'];
        
        $error='<label for="promter" class="form-label"></label>';

        $result= $database->query("select * from otp where email='$email'");

        if($result->num_rows==1){
            $otp=$result->fetch_assoc()['otp_code'];
            
            $userotp=$_POST['userotp'];
            
            if($otp==$userotp){
                $res_web = $database->query("select * from webuser where email='$email'");
    
                $usertype=$res_web->fetch_assoc()['usertype'];

                // $database->query("update webuser set status=1 where email='$email'");

                $database->query("delete from otp where email='$email'");

                $_SESSION['email']=$email;
                $_SESSION['usertype']=$usertype;

                header('Location: change-password.php');

            }else{
                $error='<label for="promter" class="form-label">Invalid OTP</label>';
            }
        }else{
            $error='<label for="promter" class="form-label">Invalid OTP</label>';
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
                        Verify OTP
                    </p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">
                        Enter the OTP sent to your email address
                        <br />
                        Email Address: <?= $_SESSION['email'] ?>
                    </p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="userotp" class="form-label">OTP: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="number" name="userotp" class="input-text" maxlength="6" placeholder="Enter OTP" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="submit" value="Verify" class="login-btn btn-primary btn">
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