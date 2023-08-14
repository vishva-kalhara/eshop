<?php

require '../connection.php';
require '../config.php';
 
require '../resources/php_mailer/SMTP.php';
require '../resources/php_mailer/PHPMailer.php';
require '../resources/php_mailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (isset($email)) {

    $response = Database::search("SELECT * FROM `eshop`.`users` WHERE `email`='$email'");
    $n = $response->num_rows;

    if ($n == 1) {
        $code = uniqid(); // Create the Code

        Database::iud("UPDATE `eshop`.`user` SET `verification_code`='$code' WHERE `email`='$email'"); 

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = fromEmail;  // From the config file
        $mail->Password = appPassword;  // From the config file
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom(fromEmail, 'Reset Password');  // From the config file
        $mail->addReplyTo(fromEmail, 'Reset Password');  // From the config file
        $mail->addAddress($email);  // Declared above
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $bodyContent = '<h1>Verification Code is ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        ob_end_clean();  // Clear the echo cache

        if ($mail->send()) {
            echo ("Email_Sent_Success");
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
