<?php 
$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_booking";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3308");
?>

<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_yPcdYCNGIPIsUlTNnWmpnr0400YTRYu5gF');

$bookingPrice = $_POST['booking_price'];
$paymentID = $_POST['payment_id'];

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
            "amount" => (float)$bookingPrice * 100,
            "currency" => "sgd",
            "customer" => $customer->id
        ));

print_r($charge);

// if (!isset($charge)) {
//     echo "<script>alert('Unsuccesful payment')</script>";
//     header("Location: ../booking/booking.php");
// }else{
//     echo "Unsucessful payment";
//     header("Location: ../booking/booking.php");
// }
?>



<html> 

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">

        <title>Update Service Provider</title>

        <link rel="stylesheet" href="">
        <!--[if lt IE 9]>
          <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    </head>

    <body>

        <div id = "main-container"> </div>

        <button id = 'updatePaymentStatusButton' class = 'btn btn-primary' href = '../booking/booking.php'> Update Payment Status</button>

        <script>
            var message = "There is an error";

            function showError(message) {
                // Hide the table and button in the event of error
                $('#updateServiceProviderBtn').hide();
            }

            check = [];

            //$('#submit').click(function () {
            $('#updatePaymentStatusButton').click(function () {

                $(async() => {

<?php
$bookingID = $_POST['booking_id'];
?>

                    var booking_id = <?php echo $bookingID ?>;

                    var serviceURL = 'http://127.0.0.1:1002/booking/payment' + '/' + booking_id;
                    console.log(serviceURL)

                    try {
                        const response =
                                await fetch(
                                        serviceURL, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                "booking_payment_status": 1
                                            })
                                        });

                        console.log(response)
                        const data = await response.json();

                    } catch (error) {
                        $('.errormsg').remove();
                        // Errors when calling the service; such as network error, 
                        // service offline, etc
                        alert("Failed");

                    } // error

                });

            })
        </script>
    </body>

</html>

