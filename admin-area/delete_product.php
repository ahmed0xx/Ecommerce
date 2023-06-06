<?php 
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete = "DELETE FROM `products` WHERE `product_id`='$delete_id'";
    $run =mysqli_query($conn,$delete);
    if($run){
        echo "<script>alert('Product deleted')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>