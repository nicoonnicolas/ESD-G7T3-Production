<!DOCTYPE HTML>
<html>
    <head>
        <title>Landing Page</title>
        <meta charset="UTF-8">
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include("../app/globalCSS.php"); ?>

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
    <body>
    <div class="container">
  <div class="row">
    <div class="col"><h1>Welcome to Paws System<br></h1><p>Login to your respective account.</p></div>
  </div>
  <div class="row">
    <div class="col-6">                    
    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Customer</h5>
                            <p class="card-text">Click below to login as Customer</p>
                            <a href="customer_amqp/customerLogin.php" class="btn btn-primary">Customer Login</a>
                        </div>
                    </div></div> 
    <div class="col-6">                  <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Service Provider</h5>
                            <p class="card-text">Click below to login as Service Provider</p>
                            <a href="serviceprovider/serviceProviderLogin.php" class="btn btn-primary">Provider Login</a>
                        </div>
                    </div></div>
  </div>

</div>


    </body>
</html>