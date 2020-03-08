<!DOCTYPE html>
<html>

    <head>
        <title>Bookings</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Localhost JS-->
        <link rel="stylesheet" type="text/css" href="js/bootstrap.bundle.js" />
        <link rel="stylesheet" type="text/css" href="js/bootstrap.bundle.js.map" />
        <link rel="stylesheet" type="text/css" href="js/bootstrap.bundle.min" />
        <link rel="stylesheet" type="text/css" href="js/bootstrap.bundle.min.js.map" />
        <link rel="stylesheet" type="text/css" href="js/bootstrap.js" />
        <link rel="stylesheet" type="text/css" href="js/bootstrap.js.map" />
        <link rel="stylesheet" type="text/css" href="js/bootstrap.min.js" />
        <link rel="stylesheet" type="text/css" href="js/bootstrap.min.js.map" />

        <!-- Localhost JQuery-->
        <link rel="stylesheet" type="text/css" href="js/jquery-3.1.1.min.js" />
        <link rel="stylesheet" type="text/css" href="js/jquery-2.1.1.js" />

        <script 
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" 
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous">
        </script>
    </head>

    <body>
        <h1 class="display-4">Bookings</h1>
        <div id="main_container" class="container">
            <p>
                <a class="btn btn-outline-info" href="../booking/booking.php">Bookings</a>
                <a class='btn btn-outline-info' href='../customer/customer.php'>Customers</a> 
                <a class='btn btn-outline-info' href='../serviceprovider/serviceprovider.php'>Service Providers</a>
            </p>
            <table id="booking_table" class='table table-striped' border='1'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Booking Number</th>
                        <th>Service Provider</th>
                        <th>Date (dd/mm/yyyy)</th>
                        <th>Time</th>
                        <th>Price</th>
                    </tr>
                <thead class='thead-dark'>
            </table>
        </div>

        <script>
            function showError(message) {
                $("#booking_table").hide();
                $("#main_container").append("<label>" + message + "</label>");
            }

            $(async () => {
                var serviceURL = "http://127.0.0.1:1002/booking";

                try {
                    const response = await fetch(serviceURL, {
                        method: "GET"
                    });
                    const data = await response.json();
                    var bookings = data.bookings;

                    if (!bookings || !bookings.length) {
                        showError("No bookings found!");
                    } else {
                        var rows = "";
                        for (const booking of bookings) {
                            var bookingDate = booking.booking_date;
                            bookingDate = bookingDate.split("-").reverse().join("/");
                            eachRow =
                                    "<td>" + booking.booking_id + "</td>" +
                                    "<td>" + booking.provider_mobile + "</td>" +
                                    "<td>" + bookingDate + "</td>" +
                                    "<td>" + booking.booking_time + "</td>" +
                                    "<td> $" + booking.booking_price + "</td>";
                            rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                        }
                        $('#booking_table').append(rows);
                    }
                } catch (error) {
                    // Errors when calling the service; such as network error, 
                    // service offline, etc
                    showError('There is a problem retrieving books data, please try again later.<br>' + error);
                } // error
            });
        </script>
    </body>

</html>