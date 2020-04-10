<?php
session_start();
if (isset($_SESSION['provider_mobile'])) {
    $providerMobile = $_SESSION['provider_mobile'];
    $providerName = '"' . $_SESSION['provider_name'] . '"';
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">

        <title>Add Service</title>

        <link rel="stylesheet" href="">
        <!--[if lt IE 9]>
          <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php include("../../app/globalSPHeader.php") ?>

        <div id="main-container" class="container">
            <h1 class="display-4" style = "padding-left: 10%;">Add Service Provider</h1>
            <form id='add_service_provider_form' method="post">
                Service: <br>
                <input type="text" id="provider_service" size="125"> 
                <br> 
                Day of Service: 
                <br>
                <select class="form-control" id="provider_day">
                    <option>mon</option>
                    <option>tue</option>
                    <option>wed</option>
                    <option>thu</option>
                    <option>fri</option>
                    <option>sat</option>
                    <option>sun</option>
                </select>
                <br> 
                Time of Service: 
                <br>
                <input type="text" id="provider_time" size="125"> 
                <br>
                Price: 
                <br>
                <input type="text" id="provider_price" size="125"> 
                <br>
                <br>
                <button id="add_service_provider_btn" type="button" class='btn btn-primary'>
                    Add Service
                </button>
            </form>
        </div>

        <!-- Copyright -->
        <footer class="page-footer font-small" style = "background-color: #007bff">
            <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
                ESD G7T3
            </div>
        </footer>

        <script>

            function showError(message) {
                // Display an error under the main container
                $('#main-container').append("<label class='errormsg'>" + message + "</label>");
            }

            $("#add_service_provider_btn").click(function () {
                $(async() => {
                    var providerService = $('#provider_service').val();
                    var providerDay = $('#provider_day').val();
                    var providerTime = $('#provider_time').val();
                    var providerPrice = $('#provider_price').val();
                    var providerMobile = <?php echo $providerMobile ?>;
                    var providerName = <?php echo $providerName ?>;
                    var serviceURL = "http://localhost:1001/serviceprovider_trial/" + providerMobile;
                    console.log(serviceURL);

                    try {
                        const response =
                                await fetch(
                                        serviceURL, {
                                            method: 'POST',
                                            headers: {
                                                "Content-Type": "application/json"
                                            },
                                            body: JSON.stringify({
                                                provider_name: providerName,
                                                provider_service: providerService,
                                                provider_time: providerTime,
                                                provider_day: providerDay,
                                                provider_price: providerPrice
                                            })
                                        });

                        console.log(response);
                        alert("Provider's Service Successfully Added!");
                        window.location.replace("serviceProvider_Trial.php");
                        const data = await response.json();
                    } catch (error) {
                        $('.errormsg').remove();
                        // Errors when calling the service; such as network error, 
                        // service offline, etc
                        showError('There is a problem retrieving Service Provider data, please try again later.<br>' + error);
                    } // error
                });
            });
        </script>
    </body>

</html>