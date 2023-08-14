<?php

require "../connection.php";

$email = $_POST["email"];
$code = $_POST["code"];
$newPassword = $_POST["newPassword"];

$res = Database::search("SELECT * FROM `eshop`.`user` WHERE `email`='$email' AND `verification_code`='$code'");
$n = $res->num_rows;

if ($n == 1) {
    Database::iud("UPDATE `eshop`.`users` SET `password`='$newPassword'");
    ob_end_clean();
    echo ("success");
} else {
    echo ("Invalid Verification Code!");
}
