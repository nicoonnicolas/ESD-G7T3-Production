<?php
session_start();
?><!DOCTYPE HTML>
<html>
    <head>
        <title>Service Provider Login</title>
        <meta charset="UTF-8">
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Latest compiled and minified CSS -->
        <link 
            rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
            integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" 
            crossorigin="anonymous">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script 
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" 
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous">
        </script>

        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous">
        </script>


    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="../../app/Paws-logo.png" width="140" height="60" alt="Paws">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>   
        </nav>

        <br/>

        <h1 class="display-4 text-center">Service Provider Login</h1>
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
        </div>
    </body>
</html>