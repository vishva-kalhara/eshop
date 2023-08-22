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
    <nav class="navbar navbar-light navbar-expand-md align-items-center" style="height: 64px;">
        <div class="container-fluid">
            <img class="navbar-brand" src="./resources/img/logo.svg" style="max-width: 40px; margin-left: 30px;" alt="">
            <!-- <a class="navbar-brand" href="#">Brand</a> -->
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div style="background-color: white;" class="collapse navbar-collapse justify-content-between align-items-center" id="navcol-1">
                <label class="form-label" style="margin-left: 10px; color: #919191; line-height:16px; font-size: 13px; margin-top: 4px; font-weight: 500;"> Hello <span style="color: #1E1E1E; font-size: 14px; font-weight: 600;">wishvakalhara@gmail.com</span></label>
                <ul class="navbar-nav justify-content-center" style="width:100%">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">First Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Second Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link justify-content-center" href="#">Third Item</a>
                    </li>
                </ul>
                <div class="dropdown justify-content-center" style="margin-right:30px;">
                    <a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" style="color: #1E1E1E; font-size: 16px; font-weight: 600; text-underline-offset: 3px;" href="#">My eShop </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">First Item</a>
                        <a class="dropdown-item" href="#">Second Item</a>
                        <a class="dropdown-item" href="#">Third Item</a>
                    </div>
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