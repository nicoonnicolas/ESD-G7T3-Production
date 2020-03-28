<!DOCTYPE HTML>
<?php
session_start();
$providerMobile = $_SESSION['provider_mobile'];
?>
<html>
    <head>
        <title>Service Providers</title>
        <meta charset="UTF-8">
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
        <h1 class="display-4">Service Providers</h1>
        <table class="table" id="service_table">
                <thead>
                <tr>
                        <th>Service Provider</th>
                        <th>Contact Number</th>
                        <th>Services Provided</th>
                        <th>Time</th>
                        <th>Day</th>
                        <th>Price</th>
                    </tr>
                </thead>
            </table>
            <a id="addReviewBtn" class="btn btn-primary" href="../serviceprovider/serviceProviderService_Trial.php">Add Service</a>
        <!-- <div id="main_container" class="container">
            <table id="service_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Service Provider</th>
                        <th>Contact Number</th>
                        <th>Services Provided</th>
                        <th>Time</th>
                        <th>Day</th>
                        <th>Price</th>
                    </tr>
                <thead class='thead-dark'>
            </table>
            <a id="addReviewBtn" class="btn btn-primary" href="../serviceprovider/serviceProviderService_Trial.php">Add Service</a>
        </div> -->
</div>
</div>
        <script>
            function showError(message) {
                $("#service_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }
            $(async() => {
                var serviceURL = "http://127.0.0.1:1001/serviceprovider_trial/" + <?php echo $providerMobile ?>;
                try {
                    const response = await fetch(serviceURL, {method: "GET"});
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
                                    "<td> $" + serviceProvider.provider_price + "</td>";
                            rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                        }
                        $("#service_table").append(rows);
                    }
                } catch (error) {
                    showError("There is a problem retrieving service provider data, please try again later.<br>" + error);
                }
            });
        </script>
    </body>
</html>

