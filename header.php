<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./resources/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="stylesheet" href="./src/product_card.css">
</head>

<body>
    <!-- <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="offset-lg-1 col-12 col-lg-3 align-self-start mt-2">

            
                // if($_SESSION["email"]){
                    
                // }
            
                <span class="text-lg-start"><b>Welcome </b>Wishva</span> |
                <span class="text-lg-start fw-bold">Sign Out</span> |
                <span class="text-lg-start fw-bold">Help and Contact</span>
            </div>

            <div class="col-12 col-lg-3 offset-lg-5 align-self-end" style="text-align: center;">
                <div class="row">

                    <div class="col-1 col-lg-3 mt-2">
                        <span class="text-start fw-bold">SELL</span>
                    </div>

                    <div class="col-12 col-lg-6 dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#profile">My Profile</a></li>
                            <li><a class="dropdown-item" href="#sellings">My Sellings</a></li>
                            <li><a class="dropdown-item" href="#products">My Products</a></li>
                            <li><a class="dropdown-item" href="#watchlist">Watchlist</a></li>
                            <li><a class="dropdown-item" href="#purchasedHistory">Purchased History</a></li>
                            <li><a class="dropdown-item" href="#messages">Messages</a></li>
                            <li><a class="dropdown-item" href="#contact">Contact Admin</a></li>
                        </ul>
                    </div>

                    <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon"></div>

                </div>
            </div>

        </div>
    </div> -->
    <nav class="navbar navbar-light navbar-expand-md align-items-center " style="height: 68px;">
        <div class="container-fluid">
            <img class="navbar-brand" src="./resources/img/logo.svg" style="max-width: 40px; margin-left: 30px;" alt="">
            <div class="input-group mb-3" style="max-width: 388px; margin-top: 10px;">
                <input style="border: none; background-color: #f4f4f4; height: 40px; width: 246px;" type="text" class="form-control" placeholder="Search for products" aria-label="Search for products" aria-describedby="basic-addon2">
                <button class="wsh-btn" style="background-color: #f4f4f4;" type="button" id="basic-addon2"><img style="width: 20px; margin-right: 5px;" src="./resources/img/icons/grid.svg" alt=""></button>
                <button class="wsh-btn" style="background-color: #1E1E1E; color: white; padding: 10px 16px 10px 16px; border-radius: 0 10px 10px 0;" type="button" id="basic-addon2">Search</button>
            </div>
            <div class="d-flex">
                <div class="dropdown justify-content-end d-flex" style=" padding:8px 16px 8px 16px; border-radius: 8px;">
                    <a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" style="color: #1E1E1E; font-size: 14px; font-weight: 600; text-decoration: none;" href="#">My eShop </a>
                    <div class="dropdown-menu" style="margin-right: 10px;">
                        <a class="dropdown-item" href="user_profile.php">My Profile</a>
                        <a class="dropdown-item" href="add_product.php">Add New Product</a>
                        <a class="dropdown-item" onclick="signout()" href="#">Sign out</a>
                    </div>
                </div>
                <div style="color: #1E1E1E; font-size: 14px; font-weight: 600; display: flex; background-color: #f4f4f4; padding:8px 16px 8px 16px; border-radius: 8px;">
                    <?php echo(isset($_SESSION["u"])? $_SESSION["u"]["fname"] : "Sign in");?>
                </div>
            </div>
        </div>
    </nav>
    <!-- <script src="./resources/bootstrap/bootstrap.js"></script>
    <script src="./resources/bootstrap/bootstrap.bundle.js"></script> -->
    <script src="./resources/bootstrap/bootstrap.min.js"></script>
    <script src="./src/script.js"></script>
</body>

</html>

<?php ?>