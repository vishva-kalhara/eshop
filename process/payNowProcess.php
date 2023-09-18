<?php
// session_start();
// require "../connection.php";

// $pid = $_GET["id"];
// $qty = $_GET["qty"];
// $umail = $_SESSION["u"]["email"];

// $order_id = uniqid();
// $array;

// if (isset($_SESSION["u"])) {


//     $product_rs = Database::search("SELECT * FROM `product WHERE `id`='" . $pid . "'");
//     $product_data = $product_rs->fetch_assoc();

//     $city_rs =  Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='$umail'");
//     $city_num = $city_rs->num_rows;

//     if ($city_num == 1) {
//         $city_data = $city_rs->fetch_assoc();
//     } else {
//         echo ("Please update the error");
//     }
// }

// $merchant_id = '1223954';
// $merchant_secret = '1223954==';
// $currency = "LKR";
// $amount = 1000;

// $hash = strtoupper(
//     md5(
//         $merchant_id .
//             $order_id .
//             number_format($amount, 2, '.', '') .
//             $currency .
//             strtoupper(md5($merchant_secret))
//     )
// );

// $array["id"] = $order_id;
// $array["item"] = "demo_item";
// $array["amount"] = $amount;
// $array["fname"] = "demo_fname";
// $array["lname"] = "demo_lname";
// $array["address"] = "uaddress";
// $array["umail"] = "email";
// $array["city"] = "demo_city";
// $array["hash"] = $hash;

// echo(json_encode($array)); 
?>

<?php
session_start();
require "../connection.php";

if(isset($_SESSION["u"])){

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'"); //TODO
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='$umail'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){
        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_id"];
        $address = $city_data["line1"].",".$city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_id"];
        $delivery = 0;

        if($district_id == 14){
            $delivery = $product_data["delivery_fee_colombo"];
        }else{
            $delivery = $product_data["delivery_fee_other"];
        }

        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $district_data["name_en"];

        $merchant_id = "1223954";
        $merchant_secret = "MTgzMDM5MTk1NDE5MzY3MTQyNTQxNzQwNjA0NzI4MzY5NTUxNDUwNw==";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $array ["id"] =$order_id;
        $array ["item"] =$item;
        $array ["amount"] =$amount;
        $array ["fname"] =$fname;
        $array ["lname"] =$lname;
        $array ["mobile"] =$mobile;
        $array ["address"] =$uaddress;
        $array ["umail"] =$umail;
        $array ["city"] =$city;
        $array ["hash"] =$hash;

        echo json_encode($array);

    }else{
        echo ("address error");
    }

}

?>