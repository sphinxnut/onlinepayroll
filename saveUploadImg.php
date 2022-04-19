<?php
    
    $myimg = $_POST['image'];
    $destinationPath = "images/";
  
    $web_capture_part = explode(";base64,", $myimg);
    $image_type_aux = explode("image/", $web_capture_part[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($web_capture_part[1]);
    $myimgName = uniqid() . '.png';
  
    $file = $destinationPath . $myimgName;
    file_put_contents($file, $image_base64);
  
    //print_r($myimgName);
  
?>