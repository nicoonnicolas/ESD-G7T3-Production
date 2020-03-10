<!DOCTYPE HTML>
<html>
    <head>
        <title>Customers</title>
        <meta charset="UTF-8">
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Latest compiled and minified CSS -->
        <link 
            rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
            integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" 
            crossorigin="anonymous">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script 
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" 
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous">
        </script>

        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous">
        </script>
    </head>
    <body>
        <h1 class="display-4">Customers</h1>
        <div id="main_container" class="container">
            <p>
                <a class="btn btn-outline-info" href="../booking/booking.php">Bookings</a>
                <a class='btn btn-outline-info' href='../customer/customer.php'>Customers</a> 
                <a class='btn btn-outline-info' href='../serviceprovider/serviceprovider.php'>Service Providers</a>
            </p>
            <table id="customer_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Customer Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                    </tr>
                <thead class='thead-dark'>
            </table>
        </div>
        <script>
            function showError(message) {
                $("#customer_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }
            $(async() => {
                var serviceURL = "http://127.0.0.1:1000/customer";
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
    </body>
</html>