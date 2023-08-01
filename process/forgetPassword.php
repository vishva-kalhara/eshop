<?php

require '../connection.php';
// require 'SMTP.php';
// require 'PHPMailer.php';
// require 'Exception.php';
require '../resources/php_mailer/SMTP.php';
require '../resources/php_mailer/PHPMailer.php';
require '../resources/php_mailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (isset($email)) {


    $response = Database::search("SELECT * FROM `eshop`.`users` WHERE `email`='$email'");
    $n = $response->num_rows;

    if ($n == 1) {
        $code = uniqid();

        Database::iud("UPDATE `eshop`.`users` SET `verification_code`='$code' WHERE `email`='$email'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vishvakalhara@gmail.com';
        $mail->Password = 'xndeeebbgiggzrbf';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('vishvakalhara@gmail.com', 'Reset Password');
        $mail->addReplyTo('vishvakalhara@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $bodyContent = '<h1>Verification Code is ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        // // $mail->CharSet = 'UTF-8';
        // $mail->SMTPKeepAlive = true;
        // echo (!extension_loaded('openssl')?"Not Available          ":"Available         ");
        // $mail->Mailer = "smtp";
        // $mail->Host = "ssl://smtp.gmail.com"; 

        if ($mail->send()) {
            echo ("success");
        } else {
            echo ("Verification Code Sending Failed.");
            echo ($mail->ErrorInfo);
        }
    } else {
        echo ("Invalid email address");
    }
} else {
    echo ('Fill the Email first!');
}
