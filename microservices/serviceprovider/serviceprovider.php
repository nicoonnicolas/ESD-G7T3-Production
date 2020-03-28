<!DOCTYPE HTML>
<html>
    <head>
        <title>Service Providers</title>
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
            <h1 class="display-4">Service Providers</h1>          

            <table class="table" id="service_table">
                <thead>
                    <tr>
                        <th>Service Provider</th>
                        <th>Contact Number</th>
                        <th colspan="3">Services Provided</th>
                        <th>Price</th>
                    </tr>
                </thead>
            </table>
        </div>
        <a id="addReviewBtn" class="btn btn-primary" href="add-serviceprovider.html">Add Provider</a>
    </div>


        <!-- <footer class="page-footer font-small" style = "background-color: #007bff">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
                ESD G7T3
            </div>
            <!-- Copyright -->

        <!-- </footer> -->
    </body>
    <script>
            function showError(message) {
                $("#service_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }
            $(async() => {
                var serviceURL = "http://127.0.0.1:1001/serviceprovider";
                try {
                    const response = await fetch(serviceURL, {method: "GET"});
                    const data = await response.json();
                    var serviceProviders = data.seviceproviders;

                    if (!serviceProviders || !serviceProviders.length) {
                        showError("No Service Providers Found!");
                    } else {
                        var rows = "";
                        for (const serviceProvider of serviceProviders) {
                            var eachRow =
                                    "<td>" + serviceProvider.provider_name + "</td>" +
                                    "<td>" + serviceProvider.provider_mobile + "</td>" +
                                    "<td>" + serviceProvider.provider_service1 + "</td>" +
                                    "<td>" + serviceProvider.provider_service2 + "</td>" +
                                    "<td>" + serviceProvider.provider_service3 + "</td>" +
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
</html>

