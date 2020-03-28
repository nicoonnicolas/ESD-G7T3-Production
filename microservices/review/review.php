<!DOCTYPE HTML>
<html>
    <head>
        <title>Reviews</title>
        <meta charset="UTF-8">
        <!-- Bootstrap libraries -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            <h1 class="display-4">Reviews</h1>          

            <table class="table" id="review_table">
                <thead>
                <tr>
                        <th>Booking ID</th>
                        <th>Stars</th>
                        <th>Comment</th>
                    </tr>
                </thead>
            </table>
        </div>
        <a id="addReviewBtn" class="btn btn-primary" href="createReview.php">Add a review</a>
    </div>

        <!-- <footer class="page-footer font-small" style = "background-color: #007bff">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3" style = "color: white;">© 2020 Copyright:
                ESD G7T3
            </div>
            <!-- Copyright -->

        <!-- </footer> -->
    </body>

    <script>

function showError(message) {
    $("#review_table").hide();
    $("#main_container").append("<label>" + message + "</label>");
}
$(async() => {
    var serviceURL = "http://127.0.0.1:1003/review";
    try {
        const response = await fetch(serviceURL, {method: "GET"});
        const data = await response.json();
        var reviews = data.reviews;

        if (!reviews || !reviews.length) {
            showError("No Reviews Found!");
        } else {
            var rows = "";
            for (const review of reviews) {
                var eachRow =
                        "<td>" + review.booking_id + "</td>" +
                        "<td>" + review.review_star + "</td>" +
                        "<td>" + review.review_comment + "</td>";
                rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
            }
            $("#review_table").append(rows);
        }
    } catch (error) {
        showError("There is a problem retrieving books data, please try again later.<br>" + error);
    }
});
</script>
</html>
