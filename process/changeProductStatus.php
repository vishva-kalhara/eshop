<?php

require '../connection.php';

$product_id = $_GET["p"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='$product_id'");
$product_num = $product_rs->num_rows;

if ($product_num == 1) {
    $product_data = $product_rs->fetch_assoc();
    $status = $product_data["status_id"];
    // echo($status);    
    if ($status == 1) {
        Database::iud("UPDATE `product` SET `status_id`='2' WHERE `id`='$product_id'");
        echo("deactivated");
    } else if ($status == 2) {
        Database::iud("UPDATE `product` SET `status_id`='1' WHERE `id`='$product_id'");
        echo("activated");
    }
} else {
    echo("Something Went Wrong");
}
