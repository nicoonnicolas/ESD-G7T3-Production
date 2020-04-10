<!DOCTYPE HTML>
<html>
    <head>
        <title>Service Providers</title>
        <meta charset="UTF-8">
        <?php include("../../app/globalCSS.php"); ?>
    </head>

    <style>
    .container-fluid {
        padding: 30px;
    }
</style>


    <body>
    <?php include("../../app/globalSPHeader.php"); ?>
        <div class="container-fluid">
        <div class="row">
        <h1 class="display-4">All Customers</h1>

        <table class="table" id="customer_table">
                <thead>
                <tr>
                        <th>Customer Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                    </tr>
                </thead>
        </table>

        <a id="addReviewBtn" class="btn btn-primary" href="createCustomer.html">Add Customer</a>

</div>
</div>
</div>

        <!-- <h1 class="display-4" style = "padding-left: 10%;">Customers</h1>
        <div id="main_container" class="container">
            <table id="customer_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Customer Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                    </tr>
                </thead>
            </table>
            <a id="addReviewBtn" class="btn btn-primary" href="createCustomer.html">Add Customer</a>
        </div> -->
    </body>

    <script>
            function showError(message) {
                $("#customer_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }
            $(async() => {
                var serviceURL = "http://127.0.0.1:1000/customer_amqp";
                try {
                    const response = await fetch(serviceURL, {method: "GET"});
                    const data = await response.json();
                    var customers = data.customers;

                    if (!customers || !customers.length) {
                        showError("No Customers Found!");
                    } else {
                        var rows = "";
                        for (const customer of customers) {
                            var eachRow =
                                    "<td>" + customer.customer_name + "</td>" +
                                    "<td>" + customer.customer_mobile + "</td>" +
                                    "<td>" + customer.customer_address + "</td>";
                            rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                        }
                        $("#customer_table").append(rows);
                    }
                } catch (error) {
                    showError("There is a problem retrieving books data, please try again later.<br>" + error);
                }
            });
        </script>
</html>