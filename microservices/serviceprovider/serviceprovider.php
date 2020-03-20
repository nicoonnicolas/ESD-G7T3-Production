<!DOCTYPE HTML>
<html>
    <head>
        <title>Service Providers</title>
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
        <h1 class="display-4">Service Providers</h1>
        <div id="main_container" class="container">
            <p>
                <a class="btn btn-outline-info" href="../booking/booking.php">Bookings</a>
                <a class='btn btn-outline-info' href='../customer/customer.php'>Customers</a> 
                <a class='btn btn-outline-info' href='../serviceprovider/serviceprovider.php'>Service Providers</a>
                <a class='btn btn-outline-info' href='../review/review.php'>Reviews</a>
            </p>
            <table id="service_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Service Provider</th>
                        <th>Contact Number</th>
                        <th colspan="3">Services Provided</th>
                        <th>Price</th>
                    </tr>
                <thead class='thead-dark'>
            </table>
            <a id="addReviewBtn" class="btn btn-primary" href="add-serviceprovider.html">Add Provider</a>
        </div>
        <script>
            function showError(message) {
                $("#service_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }
            $(async() => {
                var serviceURL = "http://127.0.0.1:1001/serviceprovider";
                try {
                    const response = await fetch(serviceURL, {method: "GET"});
                    console.log(response)
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
    </body>
</html>

