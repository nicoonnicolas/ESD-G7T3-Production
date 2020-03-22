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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="../../app/Paws-logo.png" width="140" height="60" alt="Paws">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="../../app/index.html">Home <span class="sr-only">(current)</span></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Booking
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../booking/createBooking.php">Create booking</a>
                            <a class="dropdown-item" href="../booking/updateBooking.html">Update booking</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Service Providers
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../serviceprovider/serviceProviderRegistration.php">Create Service Provider</a>
                            <a class="dropdown-item" href="../serviceprovider/updateServiceProvider.php">Update Service Provider</a>
                        </div>
                    </li>
                    <a class="nav-item nav-link" href="../review/createReview.html">Reviews</a>
                </div>
            </div>
        </nav>
        <h1 class="display-4">Service Providers</h1>
        <div id="main_container" class="container">
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
            <a id="addReviewBtn" class="btn btn-primary" href="../serviceprovider/serviceProviderRegistration.php">Add Provider</a>
        </div>
        <script>
            function showError(message) {
                $("#service_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }
            $(async() => {
                var serviceURL = "http://127.0.0.1:1001/serviceprovider_trial";
                try {
                    const response = await fetch(serviceURL, {method: "GET"});
                    console.log(response)
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

