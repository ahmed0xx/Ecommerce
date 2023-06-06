<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
.pay{
    width: 100%;
}        
</style>
<body>
    <div class="container">
        <h2 class="text-info text-center ">
            Payment options
        </h2>
    <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="col-md-6">
        <a target="_blank" href="https://www.paypal.com"><img class="pay" src="../images/payment.jpg"  alt=""></a>
        </div>
        <div class="col-md-6">
        <a href="#">
            <h2>Pay offline</h2>
        </a>
        </div>
    </div>
    </div>
</body>
</html>