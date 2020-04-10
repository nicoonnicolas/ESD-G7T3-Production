<!DOCTYPE HTML>
<?php
session_start();
if (!isset($_SESSION['provider_mobile'])) {
    header("Location: serviceProviderLogin.php"); /* Redirect browser */
    exit();
}
$providerMobile = $_SESSION['provider_mobile'];
?>
<html>
    <head>
        <title>Booking Status</title>
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
        <?php include("../../app/globalSPHeader.php")?> 
        <h1 class="display-4" style="text-align: center">Service Provider Bookings</h1>
        <div id="main_container" class="container">
            <table id="booking_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer Mobile</th>
                        <th>Customer Name</th>
                        <th>Time</th>
                        <th>Day</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                <thead class='thead-dark'>
            </table>
            <a id="addReviewBtn" class="btn btn-primary" href="../serviceprovider/serviceProviderService_Trial.php">Add Service</a>
        </div>

        <script>
            function showError(message) {
                $("#booking_table").hide();
                $("#addReviewBtn").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }

            $(async () => {
<?php
if (isset($_SESSION['provider_mobile'])) {
    $providerMobile = $_SESSION['provider_mobile'];
    ?>
                    var providerMobile = <?php echo $providerMobile ?>;
                    var serviceURL = "http://127.0.0.1:1002/booking/provider/";
                    serviceURL = serviceURL + providerMobile;
<?php } ?>
                console.log(serviceURL);
                try {
                    const response = await fetch(serviceURL, {method: "GET"});
                    const data = await response.json();
                    console.log(data);
                    var bookings = data.bookings;
                    console.log(bookings);

                    if (!bookings || !bookings.length) {
                        showError("No bookings found!");
                    } else {
                        var rows = "";
                        for (const booking of bookings) {
                            customerName = "Customer Name";
                            var eachRow = "";
                            if (booking.booking_status === 1) {
                                eachRow =
                                         "<td>" + booking.booking_id + "</td>" +
                                        "<td>" + booking.customer_mobile + "</td>" +
                                        "<td>" + booking.customer_name + "</td>" +
                                        "<td>" + booking.booking_time + "</td>" +
                                        "<td>" + booking.booking_date + "</td>" +
                                        "<td> $" + booking.booking_price + "</td>" +
                                        "<td>" + "Booking Complete" + "</td>";
                            } else {
                                eachRow =
                                        "<td>" + booking.booking_id + "</td>" +
                                        "<td>" + booking.customer_mobile + "</td>" +
                                        "<td>" + booking.customer_name + "</td>" +
                                        "<td>" + booking.booking_time + "</td>" +
                                        "<td>" + booking.booking_date + "</td>" +
                                        "<td> $" + booking.booking_price + "</td>" +
                                        "<td>" +
                                        "<form action='doServiceProviderBooking_Trial.php' method='POST'>" +
                                        "<input type='hidden' name='booking_id' value='" + booking.booking_id + "'/>" +
                                        "<input class='btn btn-primary' type='submit' value='Complete Booking'/>" +
                                        "</form>" +
                                        "</td>";
                            }
                            rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                        }
                        $('#booking_table').append(rows);
                    }
                } catch (error) {
                    // Errors when calling the service; such as network error, 
                    // service offline, etc
                    showError('There is a problem retrieving books data, please try again later.<br>' + error);
                } // error
            });
        </script>
    </body>

</html>

