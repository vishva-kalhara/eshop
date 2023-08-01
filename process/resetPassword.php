<?php

require "../connection.php";

$email = $_POST["email"];
$code = $_POST["code"];
$newPassword = $_POST["newPassword"];

$res = Database::search("SELECT * FROM `eshop`.`users` WHERE `email`='$email' AND `verification_code`='$code'");
$n = $res->num_rows;

if ($n == 1) {
    Database::iud("UPDATE `eshop`.`users` SET `password`='$newPassword'");
    echo ("success");
} else {
    echo ("Invalid Verification Code!");
}
