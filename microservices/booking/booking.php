<?php
header("Access-Control-Allow-Origin: *");
session_start();
if (isset($_GET['mobile_number'])) {
    $customerMobile = $_GET['mobile_number'];
    $_SESSION['mobile_number'] = $customerMobile;
}

$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_serviceprovidertrial";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3308");
if (!$link) {
    die(mysqli_error($link));
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bookings</title>
        <?php include("../../app/globalCSS.php"); ?>

        <style>
            .container-fluid {
                padding: 30px;
            }
        </style>

    <body>
        <?php include("../../app/globalCustomerHeader.php"); ?>
        <div class="container" style = "padding-top: 3%">
            <div class="row">
                <h1 class="display-4" style = "padding-bottom: 2%">Bookings</h1>          

                <table class="table" id="booking_table">
                    <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Service Provider</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Price</th>
                            <th>Review Status</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <a id="addReviewBtn" class="btn btn-primary" href="createBooking.php" style = "margin-right: 1%">Create Booking</a>
            <a id="addReviewBtn" class="btn btn-primary" href="updateBooking.html">Update Booking</a>

        </div>
        
    </body>

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
                                "<td>" + booking.provider_name + "</td>" +
                                "<td>" + bookingDate + "</td>" +
                                "<td>" + booking.booking_time + "</td>" +
                                "<td> $" + booking.booking_price + "</td>";
                        if (booking.booking_status === 0) {
                            eachRow +=
                                    "<td>Service Not Yet Provided</td>";
                        } else {
                            var urlString = "<a href='../review/createReview.php?booking_id="
                                    + booking.booking_id + "'>";
                            eachRow += "<td>" +
                                    urlString +
                                    "Proceed Review" +
                                    "</a>" +
                                    "</td>";
                        }

                        if (booking.booking_payment_status === 0) {
                            eachRow +=
                            "<td>" + 
                                "<form action = 'makePayment.php' method = 'post'>" +
                                    "<input type='hidden' name='payment_id' value='" + booking.booking_id + "'/>" +
                                    "<input type='hidden' name='customer_mobile' value='<?php echo $customerMobile ?>'/>" +
                                    "<input type='hidden' name='provider_name' value='" + booking.provider_name + "'/>" + 
                                    "<input type='hidden' name='booking_price' value='" + booking.booking_price + "'/>" +
                                    "<input type='hidden' name='booking_id' value='" + booking.booking_id + "'/>" + 
                                    "<input type='hidden' name='service_provided' value='" + booking.booking_price + "'/>" +
                                    "<input type='submit' class = 'btn btn-primary'  value='Not Paid' />"
                                + "</form>" 
                            + "</td>"
                        
                        } else {
                            eachRow += "<td><button class = 'btn btn-danger disabled'>Paid</button></td>";
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

</html>