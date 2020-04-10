<?php
session_start();
?><!DOCTYPE HTML>
<html>
<head>
        <title>Service Provider Login</title>
        <meta charset="UTF-8">
        <?php include("../../app/globalCSS.php"); ?>
    </head>
    <body>

    <style>
        html, body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>

    <body>

    <form class="form-signin" action="doServiceProviderLogin.php" method="POST" >
        <h1 class="h1 mb-3 font-weight-normal">Paws System</h1>
        <h2 class="h6 mb-3 font-weight-normal">Service Provider Login</h2>
        <label for="provider_mobile" class="sr-only">Mobile Number</label>
        <input type="text" name="provider_mobile" id="mobile_number" class="form-control" placeholder="Mobile Number" required autofocus> <br>
        <!-- <button class="btn btn-lg btn-primary btn-block" type="button" id="provider_login_btn">Sign in</button> -->
        <input id="provider_login_btn" type="submit" class='btn btn-lg btn-primary btn-block' value="Login"/>
        <br>
        <center><a href = "serviceProviderRegistration.php" style = "font-size: 12px;">Not an existing service provider? Click here to Sign Up.</a></center>
        <p class="mt-5 mb-3 text-muted">&copy; ESD 2020</p>
    </form>

     <!-- <h1 class="display-4 text-center">Service Provider Login</h1>
        <br/>
        <div id="main-container" class="container" style = "width: 80%;">
            <form action="doServiceProviderLogin.php" method="POST">
                <div class = "row">
                    <div class = "col-lg-6" style = "margin: 0 auto;">
                        Provider Mobile: 
                        <input type="text" name="provider_mobile" id="mobile_number" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class = "col-lg-6 text-center" style = "margin: auto;">
                        <input id="provider_login_btn" type="submit" class='btn btn-primary' value="Login"/>
                    </div>
                </div>
                <br>
            </form>
            <br>
            <div class = "row">
                <div class = "col-lg-6 text-center" style = "margin: 0 auto;">
                    <a href = "serviceProviderRegistration.php" style = "font-size: 14px;">Not an existing provider? Click here to Sign Up</a>
                </div>
            </div>
        </div> --> 
    </body>
</html>