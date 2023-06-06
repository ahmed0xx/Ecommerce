<?php
if (isset($_GET['edit'])) {
    $product_id = $_GET['edit'];
    $get_data = "SELECT * FROM `products` WHERE `product_id`='$product_id'";
    $result = mysqli_query($conn, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_desrciption'];
    $product_keywords = $row['product_keywords'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product-title" class="form-label">product title</label>
            <input type="text" id="product-title" value="<?php echo $product_title ?>" name="product_title" class="form-control" required>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product-description" class="form-label">product description</label>
            <input type="text" id="product-description" value="<?php echo $product_description ?>" name="product_description" class="form-control" required>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product-keywords" class="form-label">product keywords</label>
            <input type="text" id="product-keywords" value="<?php echo $product_keywords ?>" name="product_keywords" class="form-control" required>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product-image1" class="form-label">product image1</label>
            <div class="d-flex">
                <input type="file" id="product-image1" name="product_image1" class="form-control w-90 m-auto" required>
                <img style="width:100px;" src="./product_images/<?php echo $product_image1 ?>" alt="">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product-image2" class="form-label">product image2</label>
            <div class="d-flex">
                <input type="file" id="product-image2" name="product_image2" class="form-control w-90 m-auto" required>
                <img style="width:100px;" src="./product_images/<?php echo $product_image2  ?>" alt="">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product-image3" class="form-label">product image3</label>
            <div class="d-flex">
                <input type="file" id="product-image3" name="product_image3" class="form-control w-90 m-auto" required>
                <img style="width:100px;" src="./product_images/<?php echo $product_image3 ?>" alt="">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product-price" class="form-label">product price</label>
            <input type="text" id="product-price" value="<?php echo $product_price ?>" name="product_price" class="form-control" required>
        </div>
        <div class="w-50 m-auto">
            <input class="text-light btn btn-info px-3 my-3" type="submit" name="edit_product" value="update product">
        </div>

        <?php
        if(isset($_POST['edit_product'])){
            $product_title = $_POST['product_title'];
            $product_desc = $_POST['product_description'];
            $product_keywords = $_POST['product_keywords'];
            $product_image1= $_FILES['product_image1']['name'];
            $product_image2= $_FILES['product_image2']['name'];
            $product_image3= $_FILES['product_image3']['name'];
            $temp_image1= $_FILES['product_image1']['tmp_name'];
            $temp_image2= $_FILES['product_image2']['tmp_name'];
            $temp_image3= $_FILES['product_image3']['tmp_name'];
            $product_price = $_POST['product_price'];

            // checking for empty fields
            if($product_title=='' or $product_desc=='' or $product_keywords=='' or 
            $product_image1=='' or $product_image2=='' or $product_image3==''
            or $product_price ==''){
                echo "<script>alert('Please Fill all the fields')</script>";
                // echo "<script>window.open('edit_product.php','_self')</script>";
            }else{
                move_uploaded_file($temp_image1,"./product_images/$product_image1");
                move_uploaded_file($temp_image2,"./product_images/$product_image2");
                move_uploaded_file($temp_image3,"./product_images/$product_image3");

                // update product
                $update = "UPDATE `products` SET `product_title`='$product_title' , `product_desrciption` = '$product_description'
                ,`product_keywords`='$product_keywords' , `product_image1`='$product_image1',
                `product_image2`='$product_image2', `product_image3`='$product_image3',`product_price`='$product_price' WHERE `product_id`='$product_id'";
                $result_update = mysqli_query($conn,$update);
                if($result_update){
                echo "<script>alert('Product updated successfully')</script>";
                }


                
            }


        }
        ?>

    </form>
</div>
</body>
</html>