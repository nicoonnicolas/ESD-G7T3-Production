<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_yPcdYCNGIPIsUlTNnWmpnr0400YTRYu5gF');


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

    "amount" => 5000,
  
    "currency" => "sgd",
  
    "description" => "Grooming",
  
    "customer" => $customer->id
  
  ));
  
  print_r($charge);

?>