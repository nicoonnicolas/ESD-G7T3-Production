<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">

    <title>Homepage</title>

    <link rel="stylesheet" href="">
    <!--[if lt IE 9]>
          <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Bootstrap libraries -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
</head>

<style>
#sticky-footer {
    flex-shrink: none;
}
</style>

<body>
    <div class="jumbotron jumbotron-fluid">
        <h1 style="padding-left: 4%; padding-bottom: 3%;">My Actions <a
                href="../microservices/customer_amqp/customerDoLogout.php" class="btn btn-primary">Logout</a></h1>


        <div class="row">
            <div class="col-sm-6" style="padding-left: 4%;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Customers</h5>
                        <p class="card-text">Click here to view customer information</p>
                        <a href="../microservices/customer_amqp/customer_amqp.php" class="btn btn-primary">View
                            Customers</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="padding-right:4%">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Service Providers</h5>
                        <p class="card-text">Click here to view service provider information</p>
                        <a href="../microservices/serviceprovider/serviceProvider_Trial.php"
                            class="btn btn-primary">View Service Providers</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row" style="padding-top: 2%;">
            <div class="col-sm-6" style="padding-left: 4%;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Reviews</h5>
                        <p class="card-text">Click here to view reviews</p>
                        <a href="../microservices/review/review.html" class="btn btn-primary">View Reviews</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="padding-right:4%">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Bookings</h5>
                        <p class="card-text">Click here to view booking information</p>
                        <a href="../microservices/booking/booking.php" class="btn btn-primary">View Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer font-small" style="background-color: #007bff">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="color: white;">© 2020 Copyright:
            ESD G7T3
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
</body>

</html>