<?php


session_start();
require "../connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rememberMe"];

// echo ($email);
// echo ($password);
// echo ($rememberMe);

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
    $response = Database::search("SELECT * FROM `eshop`.`user` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $response->num_rows;

    if ($n == 1) {
        echo ("signInSuccess");
        $d = $response->fetch_assoc();
        $_SESSION["u"] = $d;


        if($rememberMe == true){
            setcookie("email",$email,time()+3600);
            setcookie("password",$password,time()+3600);
        }else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }

    } else {
        echo ("Email and password are mismatching");
    }
}
