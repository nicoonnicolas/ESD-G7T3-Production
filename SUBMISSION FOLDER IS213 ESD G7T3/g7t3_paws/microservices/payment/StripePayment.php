<?php
session_start();

if (isset($_SESSION['mobile_number'])) {
    $customerMobile = $_SESSION['mobile_number'];
} else {
    header("Location: ../customer_amqp/login.php"); /* Redirect browser */
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Pay Page</title>
    </head>
    <body>
        <?php include ("../../app/globalCustomerHeader.php") ?>
        <div class="container">
            <h2 class="my-4 text-center">Payment</h2>
            <h1 class = "display-4">Order details</h1>

            <?php
            if (isset($_SESSION['mobile_number'])) {
                $payment_id = $_POST['payment_id'];
                $booking_id = $_POST['booking_id'];
                $booking_price = $_POST['booking_price'];
                $service_provider_name = $_POST['provider_name'];

                echo "<h3> Booking ID: $booking_id</h3>";
                echo "<h3> Service Provider Name: $service_provider_name</h3>";
                echo "<h3> Total amount payable: $$booking_price</h3>";
            }
            ?> 
            <form action="charge.php" method="post" id="payment-form">
                <div class="form-row">
                    <h1 class = "display-4">Payment Details</h1>
                    <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name">
                    <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name">
                    <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address">

                    <div id="card-element" class="form-control">
                        <!-- a Stripe Element will be inserted here. -->
                    </div>
                    
                    <!-- Used to display form errors -->
                    <div id="card-errors" role="alert">
                        
                    </div>
                </div>

                <?php
                if (isset($_SESSION['mobile_number'])) {
                    $payment_id = $_POST['payment_id'];
                    $booking_id = $_POST['booking_id'];
                    $booking_price = $_POST['booking_price'];
                    $service_provider_name = $_POST['provider_name'];
                    $provider_mobile = $_POST['provider_mobile'];
                    // echo $row['payment_id'];
                    // echo $row['booking_id'];
                    // echo $row['booking_price'];
                    echo "<input type = 'hidden' name='payment_id' value= $payment_id id='payment_id'>";
                    echo "<input type = 'hidden' name='booking_id' value=$booking_id id='booking_id'>";
                    echo "<input type = 'hidden' name='booking_price' value=$booking_price id='booking_price'>";
                    echo "<input type = 'hidden' name='service_provider_name' value=$service_provider_name id='service_provider_name'>";
                    echo "<input type = 'hidden' name='provider_mobile' value=$provider_mobile id='provider_mobile'>";
                }
                ?> 
                <button>Submit Payment</button>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="../js/charge.js"></script>

    </body>
</html>