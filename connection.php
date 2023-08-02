<?php

    $database= new mysqli("localhost","root","","medical_as");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>