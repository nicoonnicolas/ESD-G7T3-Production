<?php
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">

        <title>Add Payment</title>
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
            <h1 class="display-4">Create Payment</h1>    
        </div>

        <form id='add_payment_form' method="post">
        
        <div class="form-group">
          <label for="payment_id">Payment ID</label>
          <textarea class="form-control" id="payment_id"></textarea>
        </div>
        <div class="form-group">
          <label for="booking_id">Booking ID</label>
          <textarea class="form-control" id="booking_id"></textarea>
        </div>
        <div class="form-group">
          <label for="booking_price">Booking Price</label>
          <textarea class="form-control" id="booking_price"></textarea>
        </div>
      </form>
      <button id="addPaymentBtn" type="submit" class='btn btn-primary'>Create Payment</button>
    </body>

    <script>
        $('#payment_table').hide();
        function showError(message) {
            // Hide the table and button in the event of error
            $('#payment_table').hide();
            $('#addPaymentBtn').hide();

            // Display an error under the main container
            $('#main-container')
                .append("<label class='errormsg'>" + message + "</label>");
        }

        check = [];

        //$("#submit").click(function () {
        $("#addPaymentBtn").click(function () {
            $(async () => {
                var booking_id = $('#booking_id').val();
                console.log(booking_id)
                var payment_id = $('#payment_id').val();
                var booking_price = $('#booking_price').val();
                var serviceURL = "http://localhost:1007/payment" + "/" + payment_id;
                console.log(serviceURL)

                try {
                    const response =
                        await fetch(
                            serviceURL, { 
                                method: 'POST', 
                                headers: { "Content-Type": "application/json" }, 
                                body: JSON.stringify({ booking_id: booking_id, booking_price: booking_price })  
                             });

                    console.log(response)
                    const data = await response.json();
                    
                    //var books = data; //the arr is in v.books of the JSON data
                    // array or array.length are falsy
                    //console.log(books);
                    //console.log(books.message);
                    //if(books.message != undefined) {
                    //    $('.errormsg').remove(); 
                    //    $('#booksTable').hide();
                    //    showError('Books list empty or undefined.');
                    //}
                
                    
                } catch (error) {
                    $('.errormsg').remove();
                    // Errors when calling the service; such as network error, 
                    // service offline, etc
                    showError('There is a problem retrieving books data, please try again later.<br />' + error);

                } // error
            
            });

        })
    </script>
</html>