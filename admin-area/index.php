<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
</head>
<style>
    button{
        border: 0;
        border-radius: 5px;
    }
    body{
        overflow-x: hidden;
    }

</style>
<body>
    <!-- navbar -->
   <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../images/logo.png" class="logo" alt="">
    <nav class="navbar navbar-expand-lg">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link">Welcome Admin</a>
            </li>
        </ul>
    </nav>
        </div>
    </nav>

    <!-- second child -->
    <div class="bg-light">
        <h3 class="text-center p-4">Manage Details</h3>
    </div>
    <!-- third child -->
    <div class="row">
            <div class="text-center p-5 m-2">
                <button><a href="insert_products.php" class="nav-link text-light bg-info p-2">Insert Products</a></button>
                <button><a href="index.php?view_products" class="nav-link text-light bg-info p-2">View Products</a></button>
                <button><a href="index.php?insert_category" class="nav-link text-light bg-info p-2">Insert Categories</a></button>
                <button><a href="index.php?insert_brands" class="nav-link text-light bg-info p-2">Insert Brands</a></button>
                <button><a href="index.php?list_users" class="nav-link text-light bg-info p-2">List Users</a></button>
            </div>
    </div>
    <!-- fourth child -->
    <div class="container my-5">
        <?php
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brands'])){
            include('insert_brands.php');
        }
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit'])){
            include('edit_product.php');
        }
        if(isset($_GET['delete'])){
            include('delete_product.php');
        }
        if(isset($_GET['list_users'])){
            include('list_users.php');
        }
        if(isset($_GET['id'])){
            // delete user
            $user_id = $_GET['id'];
            $select_u = "DELETE FROM `users` WHERE `user_id`='$user_id'";
            $result_u = mysqli_query($conn,$select_u);
            if($result_u){
                echo "<script>alert('user deleted') </script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
        ?>
    </div>
   </div>

<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>