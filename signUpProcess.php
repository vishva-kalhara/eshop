<?php
    require "connection.php";
    
    $fn = $_POST["fn"];
    $ln = $_POST["ln"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $mobile = $_POST["mobile"];
    $gender = $_POST["gender"];

    if(empty($fn)){
        echo ("Please enter the first name");
    } elseif (strlen($fn) > 45) {
        echo ("First name must have less than 45 characters");
    } elseif (empty($ln)) {
        echo ("Please enter the last name");
    } elseif (strlen($ln) > 45) {
        echo ("Last name must have less than 45 characters");
    } elseif (empty($email)) {
        echo ("Please enter the email");
    } elseif (strlen($email) > 100) {
        echo ("Email must have less than 100 characters");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("Invalid email address");
    } elseif (empty($password)) {
        echo ("Please enter the password");
    } elseif (strlen($password) <5 || strlen($password) > 20) {
        echo ("Password must have 5-20 characters");
    } elseif (empty($mobile)) {
        echo ("Please enter the mobile");
    } elseif (strlen($mobile) != 10) {
        echo ("Mobile number must contain 10 characters");
    } elseif (!preg_match("/07[0,1,2,5,6,7,8][0-9]/",$mobile)) {
        echo ("Please enter a valid phone number");
    } elseif ($gender == 0 ) {
        echo ("Please select the gender");
    } else {
        $rs = Database::search("SELECT * FROM `eshop`.`users` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
        $n = $rs->num_rows;
        if($n>0){
            echo ("User with the same Mobile number or Email already exists.");
        } else {
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H-i-s");

            Database::iud("INSERT INTO `eshop`.`users` (`fname`,`lname`,`email`,`password`,`mobile`,`join_date`,`status`,`gender_id`) VALUES ('".$fn."','".$ln."','".$email."','".$password."','".$mobile."','".$date."','1','".$gender."')");
            echo ("success");
        }
    }
?>

            <!-- jill-kassidy -->
