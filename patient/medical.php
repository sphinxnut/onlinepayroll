<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Medical</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");

    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch= $result->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];

    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');

 ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php?email=<?=$useremail?>"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">All Doctors</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Scheduled Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Bookings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
            <a href="medical.php" class="non-style-link-menu non-style-link-menu-active">
                <div>
                    <p class="menu-text">My Medical</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back"
                            style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php 

                                
                                echo $today;

                                

                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>


            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">
                    <!-- <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49);font-weight:400;">Scheduled Sessions / Booking / <b>Review Booking</b></p> -->

                </td>

            </tr>



            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="1"
                                style="padding: 50px;border: 1px solid rgb(221, 221, 221);border-radius: 10px;">

                                <thead>
                                    <tr>
                                        <th style="text-align: left;padding-left: 20px;">Doctor Name</th>
                                        <th style="text-align: left;padding-left: 20px;">Blood Sugar</th>
                                        <th style="text-align: left;padding-left: 20px;">Blood Pressure</th>
                                        <th style="text-align: left;padding-left: 20px;">Weight</th>
                                        <th style="text-align: left;padding-left: 20px;">Body Temperature</th>
                                        <th style="text-align: left;padding-left: 20px;">Prescription</th>
                                        <th style="text-align: left;padding-left: 20px;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                    $sqlmain= "select * from medical inner join doctor on doctor.docid=medical.doctor_id where medical.patient_id=$userid order by medical.id desc";
                        
                        // get result
                        $result = $database->query($sqlmain);

                        for ($x=0; $x<$result->num_rows;$x++){
                            $row=$result->fetch_assoc();
                            $patientid=$row["patient_id"];
                            $patientname=$row["docname"];
                            $bloodsugar=$row["blood_sugar"];
                            $bloodpressure=$row["blood_pressure"];
                            $wieght=$row["weight"];
                            $bodytemperature=$row["body_temp"];
                            $prescription=$row["prescription"];
                            $date=$row["date"];

                            echo '<tr>
                                <td> &nbsp;'.
                                substr($patientname,0,30)
                                .'</td>
                                <td>
                                    &nbsp;'.$bloodsugar.'
                                </td>
                                <td>
                                    &nbsp;'.$bloodpressure.'
                                </td>
                                <td>
                                    &nbsp;'.$wieght.'
                                </td>
                                <td>
                                    &nbsp;'.$bodytemperature.'
                                </td>
                                <td>
                                    &nbsp;'.$prescription.'
                                </td>
                                <td>
                                    &nbsp;'.$date.'
                                </td>
                            </tr>';
                        }
                            
                            ?>

                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>



    </div>

</body>

</html>