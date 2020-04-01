<?php
// session_start();
// $HOST = "localhost";
// $USERNAME = "root";
// $PASSWORD = "";
// $DB = "g7t3_booking";
// $link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3308");

// if (isset($_SESSION['mobile_number'])) {
//     $customerMobile = $_SESSION['mobile_number'];
// }

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
            "amount" => (float) $bookingPrice * 100,
            "currency" => "sgd",
            "customer" => $customer->id
        ));

// print_r($charge);

if(isset($charge)){
  

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
  $paymentID = $_POST['payment_id'];
  $bookingPrice = $_POST['booking_price'];
  $bookingID = $_POST['booking_id'];
  $providerMobile = $_POST['provider_mobile'];
  // echo $paymentID;
  // echo $bookingPrice;

  $query = "INSERT INTO payment (payment_id, booking_id, booking_price, provider_mobile) "
          . "VALUES ('$paymentID','$bookingID', $bookingPrice, '$providerMobile')";

  $result = mysqli_query($link, $query);
  // echo $result;

  if ($result) {
          // echo "<script> alert('Payment sucessfully logged. Click on the link to go back to the booking page') </script>";
          //header("Location: ../booking/booking.php");
          echo "<script>Console.log('Sucessful payment')</script>";
  }   else {
        echo "<script> alert('Unsucessful payment! Please try again ') </script>";
        header("Location: ../booking/booking.php");
      
      // $message = '<a href="booking.php">Return to previous page</a></h4>';
  }
}


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
        <script>alert("Click on the button and then the link below the button to go back to the booking page");</script>

        <!-- <form method = "POST" action = "makePayment.php">
          <input type = "hidden" name = "service_provider_name" id = "service_provider_name" value=<?php $_POST["service_provider_name"]; ?>>
          <input type = "hidden" name = "payment_id" id = "payment_id" value=<?php $_POST["payment_id"]; ?>>
          <input type = "hidden" name = "booking_price" id = "booking_price" value=<?php $_POST["booking_price"]; ?>>
          <input type = "hidden" name = "booking_id" id = "booking_id" value=<?php $_POST["booking_id"]; ?>>
          <button id = 'updatePaymentStatusButton' class = 'btn btn-primary'> Update Payment Status</button>
        </form> -->
        <div class = "container-fluid text-center" style = "margin-top: 18%"> 
          <h3>Payment Gateway Processing</h3>
          <p>Please click on the button below to confirm your payment. Button should turn green if payment is sucessful. After that click on the link to go back to the booking page</p>
          <button id = 'updatePaymentStatusButton' class = 'btn btn-primary' onclick="
this.style.backgroundColor = '#5cb85c'" style = "border: none"> Confirm Payment Status</button><br/><br/>
          <a href = "../booking/booking.php">Click on this to go back to booking</a>
        </div>
        <script>


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
                        
                        alert("Payment sucessfully logged. Click on the link to go back to the booking page");
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

