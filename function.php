<?php

require('./PHPMailer/PHPMailerAutoload.php');
function SendMail($to,$subject,$message){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ojt.rms.group.4@gmail.com';
    $mail->Password = 'hbpezpowjedwoctl';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('Medical Appointment System');
    $mail->addAddress($to);
    $mail->addReplyTo('Medical Appointment System');
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if($mail->send()){
        return true;
    }else{
        return false;
    }
}