<?php

session_start();
if (isset($_SESSION['mobile_number'])) {
    $customerMobile = $_SESSION['mobile_number'];
} else {
    header("Location: ../customer_amqp/login.php"); /* Redirect browser */
    exit();
}

echo $_POST['customer_name'];

$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_booking";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3308");
if (!$link) {
    die(mysqli_error($link));
}

$message = "";
$customerMobile = $_POST['customer_mobile'];
// echo $customerMobile;
$providerMobile = $_POST['provider_mobile'];
//echo $providerMobile;
$providerService = $_POST['provider_service'];
$providerName = $_POST['provider_name'];
$providerDay = $_POST['provider_day'];
$providerTime = $_POST['provider_time'];
$providerPrice = $_POST['provider_price'];
$customerName = $_POST['customer_name'];
$query = "INSERT INTO booking (customer_mobile, customer_name, provider_mobile, provider_name, provider_service, booking_time, booking_date, booking_price, booking_status) "
        . "VALUES ('$customerMobile', '$customerName','$providerMobile', '$providerName', '$providerService', '$providerTime', '$providerDay', '$providerPrice', 0)";
$result = mysqli_query($link, $query);
if ($result) {
    echo "<script> alert('You have created a booking.') </script>";
    //header("Location: ../booking/booking.php?mobile_number=$customerMobile");
} else {
    echo "<script> alert('Unsuccesful la fuck ') </script>";
    // $message = '<a href="booking.php">Return to previous page</a></h4>';
}

// /customer_amqp/customer_name/<string:customer_mobile>


// echo $customerMobile; echo $providerMobile; echo $providerService;
// echo "im so cute";
// Add into using microservice booking.py
// Change the booking id to AI.
// Change provider service last row to customer mobile. 
// Status (case close, can add review)
// Provider Service needs to be added. 
?>

