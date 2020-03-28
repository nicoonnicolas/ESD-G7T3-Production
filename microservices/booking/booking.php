<?php
header("Access-Control-Allow-Origin: *");
session_start();
if(isset($_GET['mobile_number'])){
    $customerMobile = $_GET['mobile_number'];
    $_SESSION['mobile_number'] = $customerMobile;
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
    <div class="container-fluid">
        <div class="row">
            <h1 class="display-4">Bookings</h1>          

            <table class="table" id="booking_table">
                <thead>
                    <tr>
                        <th>Booking Number</th>
                        <th>Service Provider</th>
                        <th>Date (dd/mm/yyyy)</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Review Status</th>
                    </tr>
                </thead>
            </table>
        </div>
        <a id="addReviewBtn" class="btn btn-primary" href="createBooking.php">Create Booking</a>
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
                                    "<td>" + booking.provider_mobile + "</td>" +
                                    "<td>" + bookingDate + "</td>" +
                                    "<td>" + booking.booking_time + "</td>" +
                                    "<td> $" + booking.booking_price + "</td>" ;
                                    // "<td>" + booking.booking_status + "</td>" ;
                                    // console.log(booking.booking_status);
                                    if (booking.booking_status === 0) {
                                        eachRow +=
                                        "<td>Not completed</td>";
                                    } else {
                                        eachRow += "<td><a href='../review/createReview.php'>Create Review</a></td>";
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