<?php

    session_start();
    
    
    if($_POST){
        $patient_id = $_POST['patient_id'];
        $doctor_id = $_POST['doctor_id'];
        $blood_sugar = $_POST['blood_sugar'];
        $blood_pressure = $_POST['blood_pressure'];
        $weight = $_POST['weight'];
        $body_temp = $_POST['body_temp'];
        $prescription = $_POST['prescription'];
        //import database
        include("../connection.php");
        //query
        $sql = "INSERT INTO medical (patient_id, doctor_id, blood_sugar, blood_pressure, weight, body_temp, prescription) VALUES ('$patient_id', '$doctor_id', '$blood_sugar', '$blood_pressure', '$weight', '$body_temp', '$prescription')";
        //execute query
        $result = mysqli_query($database, $sql);
        //check if query executed
        if($result){
            //echo "Data inserted successfully";
            $_SESSION['success'] = "Medical record added successfully";
        }else{
            //echo "Data not inserted";
            $_SESSION['error'] = "Failed to add medical record";
        }
        header("location: medical.php");
    }else{
        header("location: medical.php");
    }


?>