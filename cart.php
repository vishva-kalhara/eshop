<!DOCTYPE html>
<?php
session_start();
require './connection.php';

if (isset($_SESSION[""])) {
    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;

?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cart | eShop</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resourses/logo.svg" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php
                include "header.php";
                ?>

                <div class="col-12 pt-2" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-primary rounded mb-3">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label fs-1 fw-bold">Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Cart..." />
                                </div>
                                <div class="col-12 col-lg-2 mb-3 d-grid">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php
                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='$user'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->

                        <?php
                        } else {
                        ?>



                            <!-- products -->

                            <div class="col-12 col-lg-9">
                                <div class="row">

                                    <?php
                                    for ($i = 0; $i < $cart_num; $i++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $address_rs = Database::search("SELECT district.district_id AS `did` FROM `users_has_address INNER JOIN `city` ON users_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id WHERE users email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();
                                    }
                                    ?>

                                    <div class="card mb-3 mx-0 col-12">
                                        <div class="row g-0">
                                            <div class="col-md-12 mt-3 mb-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">John Doe</span>&nbsp;
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <!-- popup -->
                                            <div class="col-md-4">

                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="good" title="Product Description">
                                                    <img src="resourses/empty.svg" class="img-fluid rounded-start" style="max-width: 200px;">
                                                </span>

                                            </div>
                                            <!-- popup -->
                                            <div class="col-md-5">
                                                <div class="card-body">

                                                    <h3 class="card-title">Apple iPhone 12</h3>

                                                    <span class="fw-bold text-black-50">Colour : black</span> &nbsp; |

                                                    &nbsp; <span class="fw-bold text-black-50">Condition : Used</span>
                                                    <br>
                                                    <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                    <span class="fw-bold text-black fs-5">Rs. 100000 .00</span>
                                                    <br>
                                                    <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                    <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="10">
                                                    <br><br>
                                                    <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                    <span class="fw-bold text-black fs-5">Rs.250.00</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card-body d-grid">
                                                    <a class="btn btn-outline-success mb-2">Buy Now</a>
                                                    <a class="btn btn-outline-danger mb-2">Remove</a>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="col-md-12 mt-3 mb-3">
                                                <div class="row">
                                                    <div class="col-6 col-md-6">
                                                        <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                    </div>
                                                    <div class="col-6 col-md-6 text-end">
                                                        <span class="fw-bold fs-5 text-black-50">Rs.105000.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- products -->

                            <!-- summary -->
                            <div class="col-12 col-lg-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (10)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. 100000 .00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. 700 .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. 100700 .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                    </div>

                                </div>
                            </div>
                            <!-- summary -->

                        <?php
                        }
                        ?>

                    </div>
                </div>

                <?php include "footer.php"; ?>

            </div>
        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>

        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

    </html>

<?php
}
?>