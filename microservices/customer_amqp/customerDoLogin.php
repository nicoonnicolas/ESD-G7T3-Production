<?php
$customer_mobile = $_POST['mobile_number'];
echo $customer_mobile;
?>

<script>

    //$("#submit").click(function () {
    $(async () => {
        var customer_mobile = <?php echo $customer_mobile ?>;
        var serviceURL = "http://localhost:1000/customer_amqp/login/" + customer_mobile;
        console.log(serviceURL);
        try {
            const response = await fetch(serviceURL, {method: "GET"});
            const data = await response.json();
            console.log(data)
//            var customers = data.customers;

            if (!data || !data.length) {
                showError("No Customers Found!");
            } else {
<?php
//header("Location: ../../app/index.html"); /* Redirect browser */
//exit();
?>
            }
        } catch (error) {
            showError("There is a problem retrieving books data, please try again later.<br>" + error);
        }
    });

</script>