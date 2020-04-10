<?php
header("Access-Control-Allow-Origin: *");
session_start();
if (isset($_SESSION['provider_mobile'])) {
    $providerMobile = $_SESSION['provider_mobile'];
} else{
    header("Location: ../land.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Payments</title>
        <?php include("../../app/globalCSS.php"); ?>

        <style>
            .container-fluid {
                padding: 30px;
            }
        </style>

    <body>
        <?php include("../../app/globalCustomerHeader.php"); ?>
        <div class="container" style = "padding-top: 3%">
            <div class="row">
                <h1 class="display-4" style = "padding-bottom: 2%; text-align: center;">Payments that have been confirmed</h1>          
                <table class="table" id="payment_table">
                    <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Payment ID</th>
                            <th>Payment Made</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>

    <script>
        function showError(message) {
            $("#payment_table").hide();
            $("#main_container").append("<label>" + message + "</label>");
        }

        $(async () => {
            var providerMobile = <?php echo $providerMobile ?>;
            var serviceURL = "http://127.0.0.1:1007/payment/provider/" + providerMobile;
            console.log(serviceURL);
            try {
                const response = await fetch(serviceURL, {method: "GET"});
                const data = await response.json();
                console.log(data);
                var payments = data.payments;
                console.log(payments);

                if (!payments || !payments.length) {
                    showError("No payments found!");
                } else {
                    var rows = "";
                    for (const payment of payments) {
                        var eachRow =
                                "<td>" + payment.booking_id + "</td>" +
                                "<td>" + payment.payment_id + "</td>" +
                                "<td> $" + payment.booking_price + "</td>";
                        rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                    }
                    $('#payment_table').append(rows);
                }
            } catch (error) {
                // Errors when calling the service; such as network error, 
                // service offline, etc
                showError('There is a problem retrieving books data, please try again later.<br>' + error);
            } // error
        });
    </script>

</html>