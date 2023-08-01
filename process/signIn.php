<?php

require "../connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rememberMe"];

if (empty($email)) {
    echo ('Enter the Email');
} else if (strlen($email) > 100) {
    echo ('Email can contain only 100 characters maximum');
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ('Invalid Email');
} else if (empty($password)) {
    echo ('Password cannot be empty');
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ('Pasword can contain only 5 to 20 characters');
} else {
    $response = Database::search("SELECT * FROM `eshop`.`users` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $response->num_rows;

    if ($n == 1) {
        echo ('signInSuccess');
    } else {
        echo("Email and password are mismatching");
    }
}
