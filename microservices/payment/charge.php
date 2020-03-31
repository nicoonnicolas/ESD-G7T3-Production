<?php
//session_start();
//require_once('vendor/autoload.php');
//\Stripe\Stripe::setApiKey('sk_test_yPcdYCNGIPIsUlTNnWmpnr0400YTRYu5gF');
//
//$paymentID = $_POST['payment_id'];
//$bookingPrice = $_POST['booking_price'];
//$bookingID = $_POST['booking_id'];
//echo $paymentID;
//echo $bookingPrice;
//
//
//// Sanitize POST Array
//$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
//$first_name = $POST['first_name'];
//$last_name = $POST['last_name'];
//$email = $POST['email'];
//$token = $POST['stripeToken'];
//
//// Creating a customer in Stripe
//$customer = \Stripe\Customer::create(array(
//            "email" => $email,
//            "source" => $token
//        ));
//
//// Charge Customer
//$charge = \Stripe\Charge::create(array(
//            "amount" => (int) $bookingPrice * 100,
//            "currency" => "sgd",
//            "customer" => $customer->id
//        ));
//
//print_r($charge);
//
//$message = "";
//if (!isset($charge)) {
//    $message .= "This object is null";
//} else {
//    $message .= "<h2>Your payment is successful!</h2>" .
//            "<h3>Booking ID: </h3>" . $bookingID;
//} 
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="main-container" class="container">
            <h1 class="display-4" style = "padding-left: 10%;">Update Service Provider</h1>
            <table id="charge_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>
                            <h1>Your payment is successful!</h1>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Payment for Booking ID: <?php echo "50000001" . " " ?> has been made.
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td id="booking_price">
                            $ <?php echo "56.78" ?>
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>
                            <button id="charge_btn" type="button" class='btn btn-primary'>
                                Proceed Back to Bookings
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <footer class="page-footer font-small" style = "background-color: #007bff">
            <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
                ESD G7T3
            </div>
        </footer>

        <script>
            function showError(message) {
                // Hide the table and button in the event of error
                $('#charge_table').hide();
                $('#charge_btn').hide();

                // Display an error under the main container
                $('#main-container')
                        .append("<label class='errormsg'>" + message + "</label>");
            }
            $("#charge_btn").click(function () {
                $(async() => {
                    var serviceURL = "http://localhost:9999/booking/payment/" + <?php echo "50000001" ?>;
                    console.log(serviceURL);
                    try {
                        const response =
                                await fetch(
                                        serviceURL, {
                                            method: 'POST',
                                            headers: {"Content-Type": "application/json"},
                                            body: JSON.stringify({
                                                booking_payment_status: 1
                                            })
                                        });
                        console.log(response);
                        const data = await response.json();
                    } catch (error) {
                        $('.errormsg').remove();
                        showError('There is a problem retrieving books data, please try again later.<br />' + error);
                    }
                });
            });
        </script>
    </body>
</html>