<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">

        <title>Add Service Provider</title>

        <link rel="stylesheet" href="">
        <!--[if lt IE 9]>
          <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
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
                      <a class="dropdown-item" href="../microservices/booking/createBooking.html">Create booking</a>
                      <a class="dropdown-item" href="../microservices/booking/updateBooking.html">Update booking</a>
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

        <div id="main-container" class="container">
            <h1 class="display-4" style = "padding-left: 10%;">Add Service Provider</h1>
            <p>
                <a class="btn btn-outline-info" href="../booking/booking.php">Bookings</a>
                <a class='btn btn-outline-info' href='../customer/customer.php'>Customers</a> 
                <a class='btn btn-outline-info' href='../serviceprovider/serviceprovider.php'>Service Providers</a>
                <a class='btn btn-outline-info' href='../review/review.php'>Reviews</a>
            </p>
            <form id='addServiceProviderForm' method="post">
                Service Provider: <br><input type="text" id="serviceProv"> <br> Contact Number: <br><input type="text" id="contactNum"> <br> Services Provided1: <br><input type="text" id="services1"> <br> Services Provided2: <br><input type="text" id="services2">            <br> Services Provided3: <br><input type="text" id="services3"> <br> Price: <br><input type="text" id="pricing"> <br> <br>
                <button id="addServiceProviderBtn" type="button" class='btn btn-primary'>Add Service Provider</button>
            </form>
            <!-- <button id="submitBtn" type="button" class='btn btn-primary'>Search</button> -->
            <!--Placed here also can-->

            <table id="serviceProviderTable" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Serice Provider</th>
                        <th>Contact Number 13</th>
                        <th colspan="3">Services Provided</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <!-- <tbody> -->
                <!-- </tbody> -->
            </table>
            <!-- <a id="addBookBtn" class="btn btn-primary" href="add-book.html">Add a book</a> -->
        </div>

        <footer class="page-footer font-small" style = "background-color: #007bff">

          <!-- Copyright -->
          <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
          ESD G7T3
          </div>
          <!-- Copyright -->
      
        </footer>

        <script>
            $('#serviceProviderTable').hide();

            function showError(message) {
                // Hide the table and button in the event of error
                $('#serviceProviderTable').hide();
                $('#addServiceProviderBtn').hide();

                // Display an error under the main container
                $('#main-container')
                        .append("<label class='errormsg'>" + message + "</label>");
            }

            check = [];

            //$("#submit").click(function () {
            $("#addServiceProviderBtn").click(function () {
                $(async() => {
                    var serviceProvider = $('#serviceProv').val();
                    var contactNumber = $('#contactNum').val();
                    var serviceProvided1 = $('#services1').val();
                    var serviceProvided2 = $('#services2').val();
                    var serviceProvided3 = $('#services3').val();
                    var price = $('#pricing').val();

                    var serviceURL = "http://localhost:1001/serviceprovider" + "/" + contactNumber;
                    console.log(serviceURL)

                    try {
                        const response =
                                await fetch(
                                        serviceURL, {
                                            method: 'POST',
                                            headers: {
                                                "Content-Type": "application/json"
                                            },
                                            body: JSON.stringify({
                                                provider_name: serviceProvider,
                                                provider_service1: serviceProvided1,
                                                provider_service2: serviceProvided2,
                                                provider_service3: serviceProvided3,
                                                provider_price: price
                                            })
                                        });

                        console.log(response)
                        const data = await response.json();

                        //var books = data; //the arr is in v.books of the JSON data
                        // array or array.length are falsy
                        //console.log(books);
                        //console.log(books.message);
                        //if(books.message != undefined) {
                        //    $('.errormsg').remove(); 
                        //    $('#booksTable').hide();
                        //    showError('Books list empty or undefined.');
                        //}


                    } catch (error) {
                        $('.errormsg').remove();
                        // Errors when calling the service; such as network error, 
                        // service offline, etc
                        showError('There is a problem retrieving Service Provider data, please try again later.<br />' + error);

                    } // error

                });

            })
        </script>
    </body>

</html>