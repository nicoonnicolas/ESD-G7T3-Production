<!DOCTYPE HTML>
<html>
    <head>
        <title>Customer Login</title>
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
                            <a class="dropdown-item" href="../microservices/serviceprovider/createServiceProvider.html">Create Service Provider</a>
                            <a class="dropdown-item" href="../microservices/serviceprovider/updateServiceProvider.html">Update Service Provider</a>
                        </div>
                    </li>
                    <a class="nav-item nav-link" href="../microservices/review/createReview.html">Reviews</a>

                </div>
            </div>
        </nav>

        <br/>

        <h1 class="display-4 text-center">Customer Login</h1>
        <br/>
        <div id="main-container" class="container" style = "width: 80%;">
            <div class = "row">
                <div class = "col-lg-6" style = "margin: 0 auto;">
                    Mobile Number: <input type="text" name="mobile_number" id="customer_mobile" class="form-control">
                </div>
            </div>
            <br>

            <button id="addCustomerBtn" type="button" class='btn btn-primary'>Login</button>

            <br>
            <div class = "row">
                <div class = "col-lg-6 text-center" style = "margin: 0 auto;">
                    <a href = "customerRegistration.html" style = "font-size: 12px;">Not an existing user? Click here to Sign Up</a>
                </div>
            </div>
        </div>
        <script>
            $("#addCustomerBtn").click(function () {
                $(async () => {
                    var customer_mobile = $('#customer_mobile').val();
                    console.log(customer_mobile);
                    var serviceURL = "http://localhost:1000/customer_amqp/login/" + customer_mobile;
                    console.log(serviceURL);
                    try {
                        const response =
                                await fetch(serviceURL, {method: 'GET'});
                        console.log(response);
                        const data = await response.json();
                        console.log(data);
                        if ('message' in data === true) {
                            alert("Cannot log in!");
                        } else {
                            alert("Hello welcome!");
                            window.location.replace("../../app/index.html");
                        }
                    } catch (error) {
                        $('.errormsg').remove();
                        alert("Unable to login, please contact adminstrator.");
                    }
                });
            });
        </script>
    </body>
</html>