<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_yPcdYCNGIPIsUlTNnWmpnr0400YTRYu5gF');

$paymentID = $_POST['payment_id'];
$bookingPrice = $_POST['booking_price'];
$bookingID = $_POST['booking_id'];
echo $paymentID;
echo $bookingPrice;


// Sanitize POST Array

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];

$last_name = $POST['last_name'];

$email = $POST['email'];

$token = $POST['stripeToken']; 

// Creating a customer in Stripe
$customer = \Stripe\Customer::create(array(

  "email" => $email,

  "source" => $token

));

// Charge Customer

$charge = \Stripe\Charge::create(array(

    "amount" => (int)$bookingPrice * 100,
  
    "currency" => "sgd",
  
    "customer" => $customer->id
  
  ));
  
  print_r($charge);

  if(!isset($charge)){
    echo "This object is null";
  }else{
    echo "Do something else";
    echo "<script>alert('Succesful payment')</script>";
    header("Location: payment/updatePaymentStatus.php?booking_id=$bookingID");
  }

?>