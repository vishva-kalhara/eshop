<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="stylesheet" href="./src/product_card.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="./resources/img/logo.svg">
    <title>eShop | Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php include "./header.php"; ?>

            <hr />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">

                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div>

                    <div class="col-12 col-lg-6">

                        <div class="input-group mb-3 mt-3">
                            <input type="text" id="kw" class="form-control" aria-label="Text input with dropdown button" />

                            <select class="form-select" style="max-width: 250px;" id="c">
                                <option value="0">All Categories</option>

                                <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {

                                    $category_data = $category_rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>
                                    </option>

                                <?php

                                }

                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-3 mb-3" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start">
                        <a href="advanced_search.php" class="text-decoration-none link-secondary fw-bold" >Advanced</a>
                    </div>

                </div>
            </div>

            <!-- <hr /> -->


            <div class="col-12" id="basicSearchResult">
                <div class="row">
                    <div id="carouselExampleCaptions" class=" col-12 carousel slide carousel-fade" data-bs-ride="carousel" style="padding: 0;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="2500" style="background-color: antiquewhite;">
                                <img src="./resources/img/carausal/banner1.svg" class="d-block wsh-banner" />
                            </div>
                            <div class="carousel-item" data-bs-interval="2500">
                                <img src="./resources/img/carausal/banner2.svg" class="d-block wsh-banner" />
                            </div>
                            <div class="carousel-item" data-bs-interval="2500">
                                <img src="./resources/img/carausal/banner3.svg" class="d-block wsh-banner" />
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <!-- Carousel -->
                    <div style="height: 40px;"></div>

                    <?php
                    $category_res = Database::search("SELECT * FROM `eshop`.`category`");
                    $category_n = $category_res->num_rows;
                    for ($c = 0; $c < $category_n; $c++) {
                        $cat_data = $category_res->fetch_assoc();
                    ?>

                        <!-- Category Names -->
                        <div class="row justify-content-center d-flex" style="margin-top: 40px;">
                            <div style="display: flex;  justify-content: center; align-items: end;" class="col-12 ">
                                <div style="color: #9D9D9D;font-family: Poppins;font-size:24px;font-style: normal;font-weight: 600;line-height: normal;">Shop</div>
                                <div style="width: 8px;"></div>
                                <div style="color: #1e1e1e;font-family: Poppins;font-size:24px;font-style: normal;font-weight: 600;line-height: normal;"><?php echo $cat_data["cat_name"] ?></div>
                            </div>
                        </div>
                        <!-- Category Names -->
                        <div class="container wsh-product-container" style="max-width: 1100px; ">
                            <div class="row justify-content-between">
                                <?php
                                // $cat_product_res = Database::search("SELECT * FROM `eshop`.`product` WHERE `category_cat_id`=1 LIMIT 4");
                                $cat_product_res = Database::search("SELECT * FROM `eshop`.`product` WHERE `category_cat_id`='" . $cat_data["cat_id"]  . "' AND `status_id`='1' LIMIT 4");
                                $cat_product_n = $cat_product_res->num_rows;
                                for ($i = 0; $i < $cat_product_n; $i++) {
                                    $cat_product_data = $cat_product_res->fetch_assoc();

                                    $model_name_res =  Database::search("SELECT * FROM `eshop`.`model` WHERE `model_id` IN (SELECT `model_model_id` FROM `eshop`.`model_has_brand` WHERE `id` IN (SELECT `model_has_brand_id` FROM `eshop`.`product` WHERE `id`=" . $cat_product_data["id"] . "));");
                                    $model_name_data = $model_name_res->fetch_assoc();

                                    $img_path_res = Database::search("SELECT * FROM `eshop`.`product_img` WHERE `product_id` =" . $cat_product_data["id"] . " ");
                                    $img_path_data = $img_path_res->fetch_assoc();
                                ?>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">

                                        <div class="wsh-card-back">
                                            <div class="wsh-card-img-back">
                                                <!-- <img class="wsh-card-img" src="http://localhost/eshop/resources/img/product_img/p7.svg" alt="" /> -->
                                                <img class="wsh-card-img" src="<?php echo $img_path_data["img_path"] ?>" alt="" />
                                            </div>
                                            <div class="wsh-card-title"><?php echo $cat_product_data["title"] ?></div>
                                            <div class="wsh-card-model-name"><?php echo $model_name_data["model_name"]; ?></div>
                                            <div class="wsh-card-price">LKR <?php echo $cat_product_data["price"] ?></div>

                                            <div class="wsh-card-devider"></div>

                                            <div class="wsh-card-footer">
                                                <button onclick="addToWatchlist(<?php echo $cat_product_data['id'];?>);" class="wsh-btn " id="btn-like"><img src="./resources/img/icons/heart.svg" alt="" style="width: 18px;"></button>
                                                <button class="wsh-btn wsh-elevated-btn">Add to Cart</button>
                                                <a href="<?php echo "singleProductView.php?id=". ($cat_product_data["id"]); ?>" class="wsh-btn wsh-text-btn" id="btn-buy">Buy</a>
                                            </div>


                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                            <!-- <h1>2</h1> -->

                        </div>
                        <?php
                        ?>

                    <?php
                    }
                    ?>


                </div>
            </div>

            <?php include "./footer.php" ?>
        </div>
    </div>
    <script src="./src/script.js"></script>
</body>

</html>