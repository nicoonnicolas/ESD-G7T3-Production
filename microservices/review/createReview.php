<?php
session_start();
header("Access-Control-Allow-Origin: *");
if (isset($_GET['booking_id'])) {
    $bookingID = $_GET['booking_id'];
}
$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_booking";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3306");
if (!$link) {
    die(mysqli_error($link));
}

if (isset($_GET['booking_id'])) {
    $bookingID = $_GET['booking_id'];
    $query = "SELECT * FROM booking WHERE booking_id = $bookingID";
    $result = mysqli_query($link, $query);
    if ($result) {
        echo "<script> alert('Review has already been inserted! No more actions required.') </script>";
        echo "<script> window.location.replace('../booking/booking.php'); </script>";
    }
} else {
    echo "<script> alert('Booking Status Change: UNSUCCESSFUL :( ') </script>";
    $message = '<a href="serviceProviderBooking_Trial.php">Return to previous page</a></h4>';
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">

        <title>Add Review</title>
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
                <h1 class="display-4">Create Review</h1>    
            </div>

            <form id='add_review_form' method="post">
                <div class="form-group">
                    <label for="booking_id">Booking ID</label>
                    <input type="booking_id" class="form-control" id="booking_id" placeholder="Booking ID">
                </div>
                <div class="form-group">
                    <label for="review_star">Review Stars</label>
                    <select class="form-control" id="review_star">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="review_comment">Review Comments</label>
                    <textarea class="form-control" id="review_comment" rows="3"></textarea>
                </div>
            </form>
            <button id="addReviewBtn" type="submit" class='btn btn-primary'>Create Review</button>
    </body>

    <script>
        $('#booking_id').val("<?php echo $bookingID ?>");
        $('#review_table').hide();

        function showError(message) {
            // Hide the table and button in the event of error
            $('#review_table').hide();
            $('#addReviewBtn').hide();

            // Display an error under the main container
            $('#main-container')
                    .append("<label class='errormsg'>" + message + "</label>");
        }

        check = [];
        //$("#submit").click(function () {
        $("#addReviewBtn").click(function () {
            $(async () => {
                var booking_id = $('#booking_id').val();
                console.log(booking_id);
                var review_star = $('#review_star').val();
                var review_comment = $('#review_comment').val();
                var serviceURL = "http://localhost:1003/review" + "/" + booking_id;
                console.log(serviceURL);
                try {
                    const response =
                            await fetch(
                                    serviceURL, {
                                        method: 'POST',
                                        headers: {"Content-Type": "application/json"},
                                        body: JSON.stringify({review_star: review_star, review_comment: review_comment})
                                    });
                    console.log(response);
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