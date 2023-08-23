<?php
// session_start();
require './connection.php';
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
    <?php require './header.php' ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-4 border-end flex-column" style="height: 100px;">


                <img src="./resources/img/product_img/p1.jpg" alt="" class="rounded-circle" style="width: 150px; height: 150px;" />

            </div>
            <div class="col-4"></div>
        </div>
    </div>

</body>

</html>