<!DOCTYPE HTML>
<html>
    <head>
        <title>Customer Login</title>
        <meta charset="UTF-8">
        <?php include("../../app/globalCSS.php"); ?>
    </head>
    <body>

    <style>
        html, body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>

        <form class="form-signin">
        <!-- <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <h1 class="h1 mb-3 font-weight-normal">Paws System</h1>
        <h2 class="h6 mb-3 font-weight-normal">Customer Login</h2>
        <label for="inputEmail" class="sr-only">Mobile Number</label>
        <input type="text" name="mobile_number" id="customer_mobile" class="form-control" placeholder="Mobile Number" required autofocus> <br>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="addCustomerBtn">Sign in</button>
        <br>
        <center><a href = "customerRegistration.html" style = "font-size: 12px;">Not an existing user? Click here to Sign Up</a></center>
        <p class="mt-5 mb-3 text-muted">&copy; ESD 2020</p>
        </form>
    </body>

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
                            window.location.replace("../booking/booking.php?mobile_number=" + customer_mobile);
                        }
                    } catch (error) {
                        $('.errormsg').remove();
                        alert("Unable to login, please contact adminstrator.");
                    }
                });
            });
        </script>
</html>