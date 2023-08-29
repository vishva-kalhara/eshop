<?php
// session_start();
require './connection.php';
// require './config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/bootstrap/bootstrap.css">
    <!-- <link rel="stylesheet" href="./resources/bootstrap/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./src/style.css">
    <link rel="stylesheet" href="./src/product_card.css">
</head>

<body>
    <?php require './header.php';



    if (isset($_SESSION['u'])) {
        $email = $_SESSION['u']["email"];
   
        // $details_res = Database::search("SELECT * FROM `eshop`.`user` INNER JOIN `gender` ON `user`.`gender_id`=`gender`.`id` WHERE `email`='wishva@gmail.com'");
        $details_res = Database::search("SELECT * FROM `eshop`.`user` INNER JOIN `gender` ON `user`.`gender_id`=`gender`.`id` WHERE `email`='" . $email . "'");
        $image_res = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");
        $address_res = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id` = `city`.`id` INNER JOIN `district` ON `city`.`district_id` = `district`.`id` INNER JOIN `province` ON `district`.`province_id` = `province`.`id` WHERE `user_email`='" . $email . "'");

        $details_data = $details_res->fetch_assoc();
        $image_data = $image_res->fetch_assoc();
        $address_data = $address_res->fetch_assoc();
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-primary">
                <div class="row">

                    <div class="col-12 bg-body mt-4 mb-4">
                        <div class="row g-2">

                            <div class="col-md-3 border-end">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <img src="./resources/img/profile_img/dummy.jpg" class="rounded-circle mt-5" style="width: 150px;" />
                                    <br />
                                    <span class="fw-bold"><?php echo $details_data["fname"] ?></span>
                                    <span class="fw-bold text-black-50"><?php echo $details_data["email"] ?></span>
                                    <input type="file" class="d-none" id="profileImage" />
                                    <label for="profileImage" class="btn btn-primary mt-5">Update profile Image</label>
                                </div>
                            </div>
                            <div class="col-md-5 border-end">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <h4 class="fw-bold">Profile Settings</h4>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" id="fname" class="form-control" value="<?php echo $details_data["fname"] ?>" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" id="lname" class="form-control" value="<?php echo $details_data["lname"] ?>" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <label class="form-label">Mobile Number</label>
                                            <input type="text" id="mobile" class="form-control" value="<?php echo $details_data["mobile"] ?>" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">password</label>
                                            <input type="text" id="pw" class="form-control" value="<?php echo $details_data["password"] ?>" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <label class="form-label">E-mail</label>
                                            <input type="text" id="email" class="form-control" value="<?php echo $details_data["email"] ?>" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Registered Date</label>
                                            <input type="text" class="form-control" readonly value="<?php echo $details_data["joindate"] ?>" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <label class="form-label">Address 1</label>
                                            <input type="text" id="line1" class="form-control" placeholder="Address line 1" value="<?php echo (isset($address_data["line1"]) ? $address_data["line1"] : "") ?>" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Address 2</label>
                                            <input type="text" id="line2" class="form-control" placeholder="Address line 2" value="<?php echo (isset($address_data["line2"]) ? $address_data["line2"] :  "") ?>" />
                                        </div>
                                    </div>

                                    <?php
                                    $province_res = Database::search("SELECT * FROM `province`");
                                    $district_res = Database::search("SELECT * FROM `district` ");
                                    $city_res = Database::search("SELECT * FROM `city`");

                                    $province_num = $province_res->num_rows;
                                    $district_num = $district_res->num_rows;
                                    $city_num = $city_res->num_rows;
                                    ?>

                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <label class="form-label">Province</label>
                                            <select class="form-control" id="province">
                                                <option value="0">Select Province</option>
                                                <?php
                                                for ($i=0; $i < $province_num; $i++) {
                                                    $province_data = $province_res->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $province_data["id"] ?>"><?php echo $province_data["name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">District</label>
                                            <select class="form-control" id="district">
                                                <option value="0">Select District</option>
                                                <?php
                                                for ($i=0; $i < $district_num; $i++) {
                                                    $district_data = $district_res->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $district_data["id"] ?>"><?php echo $district_data["name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <label class="form-label">City</label>
                                            <select class="form-control" id="city">
                                                <option value="0">Select City</option>
                                                <?php
                                                for ($i=0; $i < $city_num; $i++) {
                                                    $city_data = $city_res->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $city_data["id"] ?>"><?php echo $city_data["name_en"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Gender</label>
                                            <?php 
                                                $gender_res = Database::search("SELECT `gender_name` FROM `eshop`.`gender` WHERE `id` IN (SELECT `gender_id` FROM `eshop`.`user` WHERE `email`='".$email."')");
                                                $gender_data = $gender_res->fetch_assoc();
                                            ?>
                                            <input type="text" class="form-control" value="<?php echo($gender_data["gender_name"]) ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row mt-4 mx-1 ">
                                        <div class="col-6">
                                            <label class="form-label">Postal Code</label>
                                            <input id="pc" type="text" class="form-control" value="<?php echo(isset($gender_data["postal_code"]) ? $gender_data["postal_code"] :"") ?>"  />
                                        </div>

                                    </div>
                                    <div class="row mt-4 mx-1 ">
                                        <button class="btn btn-primary py-2" onclick="updateProfile()">Update profile</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="row mt-5">
                                    <h3 class="text-black-50">Display Ads</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            require "./footer.php";

            ?>

        </div>
    </div>

</body>

</html>