<?php
include('../includes/connect.php');
if(isset($_POST['insert_brand'])){
    $brand_title=$_POST['brand-title'];

    $select_query = "SELECT * FROM `brands` WHERE `brand-title`='$brand_title'";
    $result = mysqli_query($conn,$select_query);
    $number = mysqli_num_rows($result);
    if ($number > 0) {
        echo "<script> alert('the brand is inside the database') </script>";
    }else{
        $insert_query = "INSERT INTO `brands` (`brand-title`) values ('$brand_title')";
        $result_insert = mysqli_query($conn,$insert_query);
        if ($result_insert) {
            echo '<script>alert("the brand had been added successfully")</script>';
        }
    }
}
?>

<h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="brand-title"
        placeholder="Insert brands" aria-label="brands"
        aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" name="insert_brand" value="Insert Brand" class="bg-info border-0 p-2 my-3">

    </div>
</form>