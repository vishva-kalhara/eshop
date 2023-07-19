<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resources/logo.svg" />
    <title>eShop</title>
</head>

<body class="main-body">
    <div class="container-lg vh-100 d-flex justify-content-center">
        <div class="row align-content-center">
            <!-- Header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to eShop</p>
                    </div>
                </div>
            </div>
            <!-- Header -->
            <!-- Content -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>
                    <!-- SIgn up form -->
                    <div class="col-12 col-lg-6" id="signupbox">
                        <div class="row g-2">
                            <!-- Title -->
                            <div class="col-12">
                                <p class="title02">Create new account</p>
                            </div>
                            <!-- Message box -->
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" id="msg" role="alert"></div>
                            </div>
                            <!-- Form -->
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" placeholder="ex: John" class="form-control" id="fname">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" placeholder="ex: Wick" class="form-control" id="lname">
                            </div>
                            <div class="col-12">
                                <label class="form-label">First Name</label>
                                <input type="email" placeholder="ex: johnwick@example.com" class="form-control border-pill" id="email">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" placeholder="ex: *********" class="form-control" id="password">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Phone number</label>
                                <input type="text" placeholder="076 222 2222" class="form-control" id="mobile">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control" id="gender">
                                    <option value="0">Select your gender</option>
                                    <?php
                                    require "connection.php";
                                    $rs = Database::search("SELECT * FROM eshop.gender");
                                    $n = $rs->num_rows;
                                    for ($i = 0; $i < $n; $i++) {
                                        $d = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Button -->
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button class="btn btn-primary" onclick="signUp()">Sign up</button>
                            </div>
                            <!-- Button -->
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button onclick="switchScreens()" class="btn btn-dark">Already have and account?</button>
                            </div>
                        </div>
                    </div>
                    <!-- SIgn up form -->

                    <!-- Sign in box -->
                    <div class="col-12 d-none col-lg-6" id="signinbox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign in</p>
                            </div>
                            <div class="col-12">
                                <label class="col-12">Email</label>
                                <input type="email" placeholder="ex: johnwick@example.com" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="col-12">Password</label>
                                <input type="email" placeholder="ex: **********" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary text-end">Forgot password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button class="btn btn-primary">Sign in</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button onclick="switchScreens()" class="btn btn-dark">Don't have an account?</button>
                            </div>
                        </div>
                    </div>
                    <!-- Sign in box -->
                </div>
            </div>
            <!-- Content -->
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>