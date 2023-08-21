<?php

require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="./resources/img/logo.svg">
    <title>eShop | Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>

            <hr />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">

                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div>

                    <div class="col-12 col-lg-6">

                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" />

                            <select class="form-select" style="max-width: 250px;">
                                <?php
                                $rs = Database::search("SELECT * FROM `eshop`.`category`");
                                $n = $rs->num_rows;

                                for ($i = 0; $i < $n; $i++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $d["cat_id"] ?>"><?php echo $d["cat_name"] ?></option>
                                <?php
                                }
                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-3 mb-3">Search</button>
                    </div>

                    <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start">
                        <a href="#" class="text-decoration-none link-secondary fw-bold">Advanced</a>
                    </div>

                </div>
            </div>

            <hr />

            <div class="col-12" id="basicSearchResult">
                <div class="row">

                    <!-- Carousel -->

                    <div id="carouselExampleCaptions" class="offset-2 col-8 carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="1000">
                                <img src="./resources/img/slider images/posterimg.jpg" class="d-block poster-img-1" />
                                <div class="carousel-caption d-none d-md-block poster-caption">
                                    <h5 class="poster-title">Welcome to eShop</h5>
                                    <p class="poster-txt">The World's Best Online Store By One Click.</p>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="1000">
                                <img src="./resources/img/slider images/posterimg2.jpg" class="d-block poster-img-1" />
                            </div>
                            <div class="carousel-item" data-bs-interval="1000">
                                <img src="./resources/img/slider images/posterimg3.jpg" class="d-block poster-img-1" />
                                <div class="carousel-caption d-none d-md-block poster-caption-1">
                                    <h5 class="poster-title">Be Free.....</h5>
                                    <p class="poster-txt">Experience the Lowest Delivery Costs With Us.</p>
                                </div>
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

                    <?php
                    $category_res = Database::search("SELECT * FROM `eshop`.`category`");
                    $category_n = $category_res->num_rows;
                    for ($c = 0; $c < $category_n; $c++) {
                        $cat_data = $category_res->fetch_assoc();
                    ?>
                        <!-- Category Names -->
                        <div class="col-12 mt-3 mb-3 " style="background-color: antiquewhite;">
                            <a href="#" class="text-decoarion-none text-dark fs-3 fw-bold"><?php echo $cat_data["cat_name"] ?></a>
                            <a href="#" class="text-decoarion-none text-dark fs-6">See All &nbsp; &rarr;</a>
                        </div>
                        <!-- Category Names -->
                        <div class="row" style="background-color: aquamarine; ">
                            <?php
                            // $cat_product_res = Database::search("SELECT * FROM `eshop`.`product` WHERE `category_cat_id`=1 LIMIT 4");
                            $cat_product_res = Database::search("SELECT * FROM `eshop`.`product` WHERE `category_cat_id`=" . $cat_data["cat_id"] . " LIMIT 4");
                            $cat_product_n = $cat_product_res->num_rows;
                            $cat_product_data = $cat_product_res->fetch_assoc();
                            for ($i = 0; $i < $cat_product_n; $i++) {
                            ?>
                                <div style=" margin-top: 24px; margin-left: 20px; max-width: 260px; background-color: white; border-radius: 10px; padding: 24px; box-sizing: border-box;">
                                    <div style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 500; color: #1e1e1e;">HP Pavilion Laptop 15t-eg300, 15.6"</div>
                                    <div style="min-width: 100%; display: flex; justify-content: center  ; margin-top: 20px;">
                                        <img src="./resources/img/product_img/p6.png" alt="">
                                    </div>
                                    <div style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; color: #1e1e1e; margin-top: 20px; min-width: 100%; display: flex; justify-content: center;">LKR 235,000</div>
                                    <div style="min-width: 100%; min-height: 1px; max-height: 1px; background-color: #E9E9E9; margin-top: 20px;"></div>
                                    <div style="min-width: 100%; display: flex; justify-content: center; margin-top: 20px;">
                                        <button style="border: none; background-color: transparent;">Add to cart</button>
                                        <button style="border: none; background-color: transparent;">Buy</button>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                        <!-- <h1>2</h1> -->

                        <?php
                        ?>

                    <?php
                    }
                    ?>


                </div>
            </div>

            <?php include "footer.php" ?>
        </div>
    </div>
    <script src="./src/script.js"></script>
</body>

</html>