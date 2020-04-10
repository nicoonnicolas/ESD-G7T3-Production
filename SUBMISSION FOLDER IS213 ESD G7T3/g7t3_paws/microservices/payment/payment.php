<!DOCTYPE HTML>
<html>
    <head>
        <title>Payments</title>
        <meta charset="UTF-8">
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include("../../app/globalCSS.php"); ?>
    </head>

    <style>
    .container-fluid {
        padding: 30px;
    }
</style>

    <body>
    <?php include("../../app/globalCustomerHeader.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="display-4">Payments</h1>          

            <table class="table" id="payment_table">
                <thead>
                <tr>
                        <th>Payment ID</th>
                        <th>Booking ID</th>
                        <th>Booking Price</th>
                    </tr>
                </thead>
            </table>
        </div>
        <a id="paymentBtn" class="btn btn-primary" href="createPayment.php">Resolve a payment</a>
    </div>

        <!-- <footer class="page-footer font-small" style = "background-color: #007bff">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
                ESD G7T3
            </div>
            <!-- Copyright -->

        <!-- </footer> -->
    </body>

    <script>

function showError(message) {
    $("#payment_table").hide();
    $("#main_container").append("<label>" + message + "</label>");
}
$(async() => {
    var serviceURL = "http://127.0.0.1:1007/payment";
    try {
        const response = await fetch(serviceURL, {method: "GET"});
        const data = await response.json();
        var payments = data.payments;

        if (!payments || !payments.length) {
            showError("No Payments Found!");
        } else {
            var rows = "";
            for (const payment of payments) {
                var eachRow =
                        "<td>" + payment.payment_id + "</td>" +
                        "<td>" + payment.booking_id + "</td>" +
                        "<td>" + payment.booking_price + "</td>";
                rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
            }
            $("#payment_table").append(rows);
        }
    } catch (error) {
        showError("There is a problem retrieving payments data, please try again later.<br>" + error);
    }
});
</script>
</html>
