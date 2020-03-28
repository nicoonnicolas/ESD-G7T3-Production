<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">

        <title>Landing</title>

        <link rel="stylesheet" href="">
        <!--[if lt IE 9]>
          <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- Bootstrap libraries -->
        <meta name="viewport" 
              content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
              integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" 
              crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script 
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script 
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>

        <script 
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="jumbotron jumbotron-fluid">
            <h1 style = "padding-left: 4%; padding-bottom: 3%; text-align: center">
                Welcome Back to PAWs!
            </h1>
            <h2 style = "padding-left: 4%; padding-bottom: 3%; text-align: center">
                Today I am a...
            </h2>
            <div class="row">
                <div class="col-sm-6" style = "padding-left: 4%;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Customer</h5>
                            <p class="card-text">Click below to login as Customer</p>
                            <a href="customer_amqp/customerLogin.php" class="btn btn-primary">Customer Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style = "padding-left: 4%;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Service Provider</h5>
                            <p class="card-text">Click below to login as Service Provider</p>
                            <a href="serviceprovider/serviceProviderLogin.php" class="btn btn-primary">Provider Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="page-footer font-large" style="background-color: #007bff">
            <div class="footer-copyright text-center py-3" style="color: white;">© 2020 Copyright: ESD G7T3 (SMU AY2019/20 Term 2)
                <marquee SCROLLAMOUNT=14 onmouseover="this.stop();" onmouseout="this.start();" style="font-size: 18px; font-weight: bold">
                    Hello visitor! Please select your usage for today. If there are any problems with the webpage, please create a ticket or inform 
                    the webmaster of the error. Where possible, include the error message that was reflected on the webpage. Have a pleasant day!
                </marquee>
            </div>
        </footer>

    </body>
</html>