<!DOCTYPE html>
<html lang="en">

<?php session_start();
        setcookie("u","ajax", time()+3600);


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css" />
    <link rel="stylesheet" href="./resources/bootstrap/bootstrap.css" />
    <link rel="icon" href="resources/img/logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
                    <div class="col-12 col-lg-6 d-none" id="signupbox">
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
                                <label class="form-label">E-mail</label>
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
                    <div class="col-12  col-lg-6" id="signinbox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign in</p>
                            </div>
                            <div class="col-12 d-none" id="msgdivSignIn">
                                <div class="alert alert-danger" id="msgSignIn" role="alert"></div>
                            </div>
                            <div class="col-12">
                                <label class="col-12">Email</label>
                                <input type="email" value="" id="email2" placeholder="ex: johnwick@example.com" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="col-12">Password</label>
                                <input type="email" value="" id="password2" placeholder="ex: **********" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label" for="rememberme">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" onclick="forgetPassword()" class="link-primary text-end">Forgot password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button onclick="signIn()" class="btn btn-primary">Sign in</button>
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
            <div class="modal" id="forgotPasswordModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row gap-0">
                                <div class="col-8">
                                    <input type="email" class="form-control" value="name@gmail.com" id="modalEmail" disabled />
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" placeholder="Verification code" id="modalCode" />
                                </div>

                            </div>
                            <div class="row">
                                <div style="height: 16px;"></div>
                            </div>
                            <div class="row gap-0">
                                <div class="col-6">
                                    <!-- <label class="form-label">New Password</label> -->
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="New Password" id="modalNewPassword" />
                                        <button class="btn btn-primary" onclick="showHidePassword()" style="opacity: .5;" type="button" id="btnPass1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <!-- <label class="form-label">New Password</label> -->
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="modalConfPassword" />
                                        <button class="btn btn-primary" style="opacity: .5;" type="button" id="btnPass2">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="resetPassword()" id="modalBtnReset" class="btn btn-primary">Reset Password</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./src/script.js"></script>
    <script src="./resources/bootstrap/bootstrap.js"></script>
</body>

</html>