<?php
session_start();

if (isset($_SESSION['mobile_number'])) {
    $customerMobile = $_SESSION['mobile_number'];
} else {
    header("Location: ../customer_amqp/customerLogin.php"); /* Redirect browser */
    exit();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Create Booking</title>
    <meta charset="UTF-8">
    <?php include("../../app/globalCSS.php"); ?>
</head>

<style>
    .container-fluid {
        padding: 30px;
    }
</style>

<body>
    <?php include("../../app/globalCustomerHeader.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="display-4">Create Booking</h1>          

            <table class="table" id="service_table">
                <thead>
                    <tr>
                    <th>Service Provider</th>
                    <th>Contact Number</th>
                    <th>Services Provided</th>
                    <th>Time</th>
                    <th>Day</th>
                    <th>Price</th>
                    <th>Select</th>
                    </tr>
                </thead>
            </table>
        </div>
        <a id="addReviewBtn" class="btn btn-primary" href="../serviceprovider/serviceProviderRegistration.html">Add
            Provider</a>
    </div>

    <!--  <h1 class="display-4" style="padding-left: 10%;">Create Booking</h1>
    <div id="main-container" class="container">
        <table id="service_table" class='table table-striped' border='1'>
            <thead class='thead-dark'>
                <tr>
                    <th>Service Provider</th>
                    <th>Contact Number</th>
                    <th>Services Provided</th>
                    <th>Time</th>
                    <th>Day</th>
                    <th>Price</th>
                    <th>Select</th>
                </tr>
                <thead class='thead-dark'>
        </table> -->
        <!-- <a id="addReviewBtn" class="btn btn-primary" href="../serviceprovider/serviceProviderRegistration.html">Add
            Provider</a> -->
    <!-- </div> --> 
    
    <!-- <div class="footer-copyright text-center py-3" style="color: white;">© 2020 Copyright:
        ESD G7T3
    </div> -->
</body>

<script>
    function showError(message) {
        $("#service_table").hide();
        $("#main_container").append("<label>" + message + "</label>");
    }
    $(async () => {
        var serviceURL = "http://127.0.0.1:1001/serviceprovider_trial";
        try {
            const response = await fetch(serviceURL, {
                method: "GET"
            });
            console.log(response);
            const data = await response.json();
            console.log(data);
            var serviceProviders = data.serviceProviders;
            console.log(serviceProviders);

            if (!serviceProviders || !serviceProviders.length) {
                showError("No Service Providers Found!");
            } else {
                var rows = "";
                for (const serviceProvider of serviceProviders) {
                    var eachRow =
                        "<td>" + serviceProvider.provider_mobile + "</td>" +
                        "<td>" + serviceProvider.provider_name + "</td>" +
                        "<td>" + serviceProvider.provider_service + "</td>" +
                        "<td>" + serviceProvider.provider_time + "</td>" +
                        "<td>" + serviceProvider.provider_day + "</td>" +
                        "<td>" + serviceProvider.provider_price + "</td>" +
                        "<td>" +
                        "<form action='doCreateBooking.php' method='POST'>" +
                        "<input type='hidden' name='customer_mobile' value='<?php echo $customerMobile ?>'/>" +
                        "<input type='hidden' name='provider_name' value='" + serviceProvider
                        .provider_name + "'/>" +
                        "<input type='hidden' name='provider_mobile' value='" + serviceProvider
                        .provider_mobile + "'/>" +
                        "<input type='hidden' name='provider_name' value='" + serviceProvider
                        .provider_name + "'/>" +
                        "<input type='hidden' name='provider_time' value='" + serviceProvider
                        .provider_time + "'/>" +
                        "<input type='hidden' name='provider_day' value='" + serviceProvider.provider_day +
                        "'/>" +
                        "<input type='hidden' name='provider_service' value='" + serviceProvider
                        .provider_service + "'/>" +
                        "<input type='hidden' name='provider_price' value='" + serviceProvider
                        .provider_price + "'/>" +
                        "<input type='submit' value='Book' /></form>" +
                        "</td>"
                        ;

                    rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                }
                $("#service_table").append(rows);
            }
        } catch (error) {
            showError("There is a problem retrieving service provider data, please try again later.<br>" +
                error);
        }
    });
    </script>

</html>