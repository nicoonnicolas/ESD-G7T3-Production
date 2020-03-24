<!DOCTYPE HTML>
<html>
    <head>
        <title>Customer Login</title>
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
        <h1 class="display-4 text-center">Customer Login</h1>
        <br/>
        <div id="main-container" class="container" style = "width: 80%;">
            <div class = "row">
                <div class = "col-lg-6" style = "margin: 0 auto;">
                    Mobile Number: <input type="text" name="mobile_number" id="customer_mobile" class="form-control">
                </div>
            </div>
            <br>

            <button id="addCustomerBtn" type="button" class='btn btn-primary'>Login</button>

            <br>
            <div class = "row">
                <div class = "col-lg-6 text-center" style = "margin: 0 auto;">
                    <a href = "customerRegistration.html" style = "font-size: 12px;">Not an existing user? Click here to Sign Up</a>
                </div>
            </div>
        </div>
        <script>
            $("#addCustomerBtn").click(function () {
                $(async () => {
                    var customer_mobile = $('#customer_mobile').val();
                    console.log(customer_mobile);
                    var serviceURL = "http://localhost:1000/customer_amqp/login/" + customer_mobile;
                    console.log(serviceURL);
                    try {
                        const response =
                                await fetch(serviceURL, {method: 'GET'});
                        console.log(response);
                        const data = await response.json();
                        console.log(data);
                        if ('message' in data === true) {
                            alert("Cannot log in!");
                        } else {
                            alert("Hello welcome!");
                            window.location.replace("../../app/index.html");
                        }
                    } catch (error) {
                        $('.errormsg').remove();
                        alert("Unable to login, please contact adminstrator.");
                    }
                });
            });
        </script>
    </body>
</html>