@@ -1,126 +0,0 @@
<!DOCTYPE HTML>
<html>
    <head>
        <title>Customers</title>
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
                            <a class="dropdown-item" href="../booking/createBooking.html">Create booking</a>
                            <a class="dropdown-item" href="../booking/updateBooking.html">Update booking</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Service Providers
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../serviceprovider/createServiceProvider.html">Create Service Provider</a>
                            <a class="dropdown-item" href="../serviceprovider/updateServiceProvider.html">Update Service Provider</a>
                        </div>
                    </li>
                    <a class="nav-item nav-link" href="../review/createReview.html">Reviews</a>
                </div>
            </div>
        </nav>

        <br>

        <h1 class="display-4" style = "padding-left: 10%;">Customers</h1>
        <div id="main_container" class="container">
            <table id="customer_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Customer Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                    </tr>
                </thead>
            </table>
            <a id="addReviewBtn" class="btn btn-primary" href="createCustomer.html">Add Customer</a>
        </div>

        <br/>

        <footer class="page-footer font-small" style = "background-color: #007bff">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
                ESD G7T3
            </div>
            <!-- Copyright -->

        </footer>

        <script>
            function showError(message) {
                $("#customer_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }
            $(async() => {
                var serviceURL = "http://127.0.0.1:1000/customer";
                try {
                    const response = await fetch(serviceURL, {method: "GET"});
                    const data = await response.json();
                    var customers = data.customers;

                    if (!customers || !customers.length) {
                        showError("No Customers Found!");
                    } else {
                        var rows = "";
                        for (const customer of customers) {
                            var eachRow =
                                    "<td>" + customer.customer_name + "</td>" +
                                    "<td>" + customer.customer_mobile + "</td>" +
                                    "<td>" + customer.customer_address + "</td>";
                            rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                        }
                        $("#customer_table").append(rows);
                    }
                } catch (error) {
                    showError("There is a problem retrieving books data, please try again later.<br>" + error);
                }
            });
        </script>
    </body>
</html>