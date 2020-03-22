<?php
header("Access-Control-Allow-Origin: *");
session_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Bookings</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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


    <body>
        <h1 class="display-4">Bookings</h1>
        <div id="main_container" class="container">
            <p>
                <a class="btn btn-outline-info" href="../booking/booking.php">Bookings</a>
                <a class='btn btn-outline-info' href='../customer/customer.php'>Customers</a> 
                <a class='btn btn-outline-info' href='../serviceprovider/serviceprovider.php'>Service Providers</a>
                <a class='btn btn-outline-info' href='../review/review.php'>Reviews</a>
            </p>
            <table id="booking_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Booking Number</th>
                        <th>Service Provider</th>
                        <th>Date (dd/mm/yyyy)</th>
                        <th>Time</th>
                        <th>Price</th>
                    </tr>
                <thead class='thead-dark'>
            </table>
            <a id="addReviewBtn" class="btn btn-primary" href="createBooking.php">Create Booking</a>
            <a id="addReviewBtn" class="btn btn-primary" href="updateBooking.html">Update Booking</a>

        </div>

        <script>
            function showError(message) {
                $("#booking_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }

            $(async () => {
<?php
if (isset($_SESSION['mobile_number'])) {
    $customerMobile = $_SESSION['mobile_number'];
    ?>
                    var customerMobile = <?php echo $customerMobile ?>;
                    var serviceURL = "http://127.0.0.1:1002/booking/";
                    serviceURL = serviceURL + customerMobile;
<?php } else {
    ?>
                    var serviceURL = "http://127.0.0.1:1002/booking";
<?php }
?>
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
                            var bookingDate = booking.booking_date;
                            bookingDate = bookingDate.split("-").reverse().join("/");
                            eachRow =
                                    "<td>" + booking.booking_id + "</td>" +
                                    "<td>" + booking.provider_mobile + "</td>" +
                                    "<td>" + bookingDate + "</td>" +
                                    "<td>" + booking.booking_time + "</td>" +
                                    "<td> $" + booking.booking_price + "</td>";
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