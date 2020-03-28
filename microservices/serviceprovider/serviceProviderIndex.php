<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">

    <title>Service Provider Home</title>
    <?php include("../../app/globalCSS.php"); ?>
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <h2 style="padding-left: 4%; padding-bottom: 3%;">My Actions</h2>

        <div class="row">
            <div class="col-sm-6" style="padding-left: 4%;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Customers</h5>
                        <p class="card-text">Click here to view customer information</p>
                        <a href="../customer_amqp/customer_Trial.php" class="btn btn-primary">View Customers</a>
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
                        <a href="../booking/booking.php" class="btn btn-primary">View Bookings</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 2%; padding-left: 3%">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Thank you for using our services</p>
                        <a href="../customer_amqp/customerDoLogout.php" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small" style="background-color: #007bff">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="color: white;">© 2020 Copyright:
            ESD G7T3
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    <!-- <div id="main-container" class="container">
            <h1 class="display-4">Book Listing</h1>
            <table id="booksTable" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Title</th>
                        <th>ISBN 13</th>
                        <th>Price</th>
                        <th>Availability</th>
                    </tr>
                </thead>
            </table>
            <a id="addBookBtn" class="btn btn-primary" href="add-book.html">Add a book</a>
        </div>
        <script>
            // Helper function to display error message
            function showError(message) {
                // Hide the table and button in the event of error
                $('#booksTable').hide();
                $('#addBookBtn').hide();
        
                // Display an error under the main container
                $('#main-container')
                    .append("<label>"+message+"</label>");
            }
        
            // anonymous async function - using await requires the function that calls it to be async
            $(async() => {           
                // Change serviceURL to your own
                var serviceURL = "http://127.0.0.1:5000/book";
        
                try {
                    const response =
                    await fetch(
                        serviceURL, { method: 'GET' }
                    );
                    const data = await response.json();
                    var books = data.books; //the arr is in data.books of the JSON data
                    // array or array.length are falsy
                    if (!books || !books.length) {
                        showError('Books list empty or undefined.')
                    } else {
                        // for loop to setup all table rows with obtained book data
                        var rows = "";
                        for (const book of books) {
                            eachRow =
                                "<td>" + book.title + "</td>" +
                                "<td>" + book.isbn13 + "</td>" +
                                "<td>" + book.price + "</td>" +
                                "<td>" + book.availability + "</td>";
                            rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                        }
                        // add all the rows to the table
                        $('#booksTable').append(rows);
                    }
                } catch (error) {
                    // Errors when calling the service; such as network error, 
                    // service offline, etc
                    showError
                      ('There is a problem retrieving books data, please try again later.<br />'+error);
                   
                } // error
            });
        </script> -->
</body>

</html>