
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

/*
$message = "";
if (isset($_POST['booking_id'])) {
    $bookingID = $_POST['booking_id'];
    $query = "UPDATE booking SET booking_status = 1 WHERE booking_id = $bookingID";
    $result = mysqli_query($link, $query);
    if ($result) {
        echo "<script> alert('Booking Status has been updated: Completed!') </script>";
    }
} else {
    echo "<script> alert('Booking Status Change: UNSUCCESSFUL :( ') </script>";
    $message = '<a href="serviceProviderBooking_Trial.php">Return to previous page</a></h4>';
}
*/
?>
<!-- <!DOCTYPE HTML>
<html>

<body>
    
    
    <?php if ($message == "") { ?>
    <meta http-equiv="refresh" content="0; url=serviceProviderBooking_Trial.php">
    <?php
        } else {
            echo $message;
        }
        ?>
</body>

</html> -->

<html>

    <head>
        <script src="https://js.stripe.com/v3/"></script>

        <title>Bookings</title>
        <?php include("../../app/globalCSS.php"); ?>

    <style>
        .container-fluid {
            padding: 30px;
        }
        
    </style>

    <body>

    <?php include("../../app/globalCustomerHeader.php"); ?>
    <div class = "container">

        <form action="/charge" method="post" id="payment-form">
            <h5 class = "display-4" style = "padding-top: 3%">Billing Details</h5>
            <hr/>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="hello@paws.com">
                </div>
                <div class="form-group col-md-6">
                <label for="inputMobileNumber">Mobile Number</label>
                <input type="text" class="form-control" id="inputMobileNumber" placeholder="Mobile Number">
                </div>
            </div>
            <div class="form-group">
                <label for="billingAddress">Billing Address</label>
                <input type="text" class="form-control" id="billingAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="additionalFootnotes">Address 2</label>
                <input type="text" class="form-control" id="additionalFootnotes" placeholder="Leave blank if there ar enot special requests">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
                </div>
                
                <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip">
                </div>
            </div>

            <h5 class = "display-4" style = "padding-top: 3%">Payment Details</h5>
            <hr/>

            <div class="form-group">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    I agree to the <a href = "#">terms and conditions</a>
                </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Make </button>
            <?php 
            $query = "SELECT  FROM booking "
            . "WHERE inputMobileNumber = '$customer_mobile' AND  ";
            //        echo $query;
            $result = mysqli_query($link, $query);
            
            echo "Price payable is"?>
        </form>
    </div>    

    </body>

</html>