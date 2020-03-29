<?php
session_start();
$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_booking";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3308");
if (!$link) {
    die(mysqli_error($link));
}

$message = "";
if (!isset($_POST['booking_id'])) {
    $bookingID = $_GET['booking_id'];
    echo $bookingID;
    $query = "UPDATE booking SET booking_payment_status = 5 WHERE booking_id = $bookingID";
    $result = mysqli_query($link, $query);
    if ($result) {
        echo "<script> alert('Booking Status has been updated: Completed!') </script>";
        header("Location: ../booking/booking.php);
    }
} else {
    echo "<script> alert('Booking Status Change: UNSUCCESSFUL :( ') </script>";
    $message = '<a href="serviceProviderBooking_Trial.php">Return to previous page</a></h4>';
}
?>