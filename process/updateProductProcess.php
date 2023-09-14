<?php
session_start();
require "../connection.php";

if(isset($_SESSION["p"])){
    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $desc = $_POST["d"];

    Database::iud("UPDATE `product` SET `title`='".$title."',`qty`='".$qty."',
                `delivery_fee_colombo`='".$dwc."',`delivery_fee_other`='".$doc."',
                `description`='".$desc."' WHERE `id`='".$pid."'");

    $length = sizeof($_FILES);

if($length <= 3 && $length > 0){

    Database::iud("DELETE FROM `product_img` WHERE `product_id`='".$pid."'");

    $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    for($x = 0;$x < $length;$x++){
        if(isset($_FILES["i".$x])){

            $img_file = $_FILES["i".$x];
            $file_extention = $img_file["type"];

            if(in_array($file_extention,$allowed_img_extentions)){

                $new_img_extention;

                if($file_extention == "image/jpg"){
                    $new_img_extention = ".jpg";
                }else if($file_extention == "image/jpeg"){
                    $new_img_extention = ".jpeg";
                }else if($file_extention == "image/png"){
                    $new_img_extention = ".png";
                }else if($file_extention == "image/svg+xml"){
                    $new_img_extention = ".svg";
                }

                $location_w_name = "resources//img//product_img//".$title."_".$x."_".uniqid().$new_img_extention;
                $save_location_w_name = "../" . $location_w_name;
                move_uploaded_file($img_file["tmp_name"],$save_location_w_name);

                Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) 
                                VALUES ('".$location_w_name."','".$pid."')");

                echo ("success");

            }else{
                echo ("Not an allowed image type.");
            }

        }
    }

}else{
    echo ("Invalid Image Count");
}

}
?>