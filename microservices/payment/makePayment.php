<?php

session_start();
if (isset($_SESSION['mobile_number'])) {
    $customerMobile = $_SESSION['mobile_number'];

} else {
    header("Location: ../customer_amqp/login.php"); /* Redirect browser */
    exit();
}

$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_payment";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3308");
if (!$link) {
    die(mysqli_error($link));
}

$message = "";
$customerMobile = $_POST['customer_mobile'];
echo $customerMobile;
$paymentID = $_POST['payment_id'];
$bookingPrice = $_POST['booking_price'];
$bookingID = $_POST['booking_id'];
echo $paymentID;
echo $bookingPrice;

$query = "INSERT INTO payment (payment_id, booking_id, booking_price) "
        . "VALUES ('$paymentID','$bookingID', '$bookingPrice')";

$result = mysqli_query($link, $query);
echo $result;

if ($result) {
        echo "<script> alert('Redirecting to payment gateway') </script>";
        //header("Location: ../booking/booking.php");
}   else {
    echo "<script> alert('Unsuccesful la fuck ') </script>";
    
    // $message = '<a href="booking.php">Return to previous page</a></h4>';
}



// echo $customerMobile; echo $providerMobile; echo $providerService;
// echo "im so cute";

// Add into using microservice booking.py
// Change the booking id to AI.
// Change provider service last row to customer mobile. 
// Status (case close, can add review)
// Provider Service needs to be added. 

?>