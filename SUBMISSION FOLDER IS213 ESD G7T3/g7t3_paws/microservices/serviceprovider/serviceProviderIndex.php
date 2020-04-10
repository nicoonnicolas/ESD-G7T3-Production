<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">

    <title>Service Provider Home</title>
    <?php include("../../app/globalCSS.php"); ?>
</head>

<style>
    .container-fluid {
        padding: 30px;
    }
</style>

<body>
<?php include("../../app/globalSPHeader.php"); ?>
<div class="container-fluid">

        <div class="row">
            <div class="col-sm-6" style="padding-left: 4%;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Customers</h5>
                        <p class="card-text">Click here to view customer information</p>
                        <a href="../customer_amqp/customer_amqp.php" class="btn btn-primary">View Customers</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="padding-right:4%">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Service Providers</h5>
                        <p class="card-text">Click here to view service provider information</p>
                        <a href="../serviceprovider/serviceProvider_Trial.php" class="btn btn-primary">View Service
                            Providers</a>
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
                        <a href="../review/review.php" class="btn btn-primary">View Reviews</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="padding-right:4%">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Bookings</h5>
                        <p class="card-text">Click here to view booking information</p>
                        <a href="../serviceprovider/serviceProviderBooking_Trial.php" class="btn btn-primary">View Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- <footer class="page-footer font-small" style="background-color: #007bff">

        <!-- Copyright -->
        <!-- <div class="footer-copyright text-center py-3" style="color: white;">© 2020 Copyright:
            ESD G7T3
        </div>
        Copyright -->

    <!-- </footer>  -->
    <!-- Footer -->


</body>

</html>