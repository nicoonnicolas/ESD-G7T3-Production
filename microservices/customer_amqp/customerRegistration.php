<!DOCTYPE HTML>
<html>
    <head>
        <title>Customer Registration</title>
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
        <h1 class="display-4 text-center">Customer Registration</h1>
        <br/>
        <div id="main-container" class="container" style = "width: 80%;">
            <form id='addCustomerForm' method="POST">
                <div class="row">
                    <div class="col">
                        Name:<input type="text" class="form-control" id = "customer_name">
                    </div>
                    <div class="col">
                        Mobile Number: <input type="text" class="form-control" id = "customer_mobile">
                    </div>
                </div>
                <br/>
                <!-- Customer Full Name: <br><input type="text" id="customer_name"> <br>
                Mobile Number: <br><input type="text" id="customer_mobile"> <br> -->
                <div class = "row">
                    <div class = "col">
                        Address: <br><input type="text" id="customer_address" class = "form-control"> <br>
                    </div>
                    <div class = "col"></div>
                </div>
                <br>
                <button id="addCustomerBtn" type="button" class='btn btn-primary'>Register</button>
            </form>

            <br/>
            <div class = "row">
                <div class = "col-lg-6 text-center" style = "margin: 0 auto;">
                    <a href = "customerLogin.html" style = "font-size: 12px;">Already an existing user? Click here to Sign In</a>
                </div>
            </div>
        </div>

        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <footer class="page-footer font-small" style = "background-color: #007bff;">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
                ESD G7T3
            </div>
            <!-- Copyright -->

        </footer>

        <script>
            $('#customer_table').hide();
            function showError(message) {
                // Hide the table and button in the event of error
                $('#customer_table').hide();
                $('#addCustomerBtn').hide();

                // Display an error under the main container
                $('#main-container').append("<label class='errormsg'>" + message + "</label>");
            }

            check = [];

            //$("#submit").click(function () {
            $("#addCustomerBtn").click(function () {
                $(async () => {
                    var customer_name = $('#customer_name').val();
                    var customer_mobile = $('#customer_mobile').val();
                    var customer_address = $('#customer_address').val();
                    console.log(customer_name);
                    console.log(customer_mobile);
                    console.log(customer_address);
                    var serviceURL = "http://localhost:1000/customer_amqp/register/" + customer_mobile;
                    console.log(serviceURL);
                    try {
                        const response =
                                await fetch(
                                        serviceURL, {
                                            method: 'POST',
                                            headers: {"Content-Type": "application/json"},
                                            body: JSON.stringify({customer_name: customer_name, customer_address: customer_address})
                                        });
                        console.log(response);
                        const data = await response.json();
                        console.log(data)
                        alert("Sucessfully Registered for account");
                    } catch (error) {
                        $('.errormsg').remove();
                        // Errors when calling the service; such as network error, 
                        // service offline, etc
                        showError('There is a problem retrieving customer data, please try again later.<br>' + error);
                    } // error
                });
            });
        </script>
    </body>
</html>
