<!-- include files -->
<?php
// connection file
include('includes/connect.php');
// functions file
include('functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-commerce website</title>
  <!-- bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css file -->
  <link rel="stylesheet" href="style.css">
  <style>
    body{
      overflow-x: hidden;
    }
  </style>
</head>
<body>
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <img src="./images/logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <?php 
              if(!isset($_SESSION['username'])){
                echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
              </li>";
              }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_items() ;?></sup></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Total Price: <?php total_price()?></a>
            </li>
          </ul>
          <form class="d-flex" role="search" method="get" action="search_product.php">
            <input class="form-control me-2" type="search" name="search_product" placeholder="Search" aria-label="Search">
            <input type="submit" value="search" name="search_data_product" class="btn btn-outline-light">
          </form>
        </div>
      </div>
    </nav>
    <!-- calling cart function -->
    <?php
    cart();
    ?>
    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php
        if (!isset($_SESSION['username'])) {
          echo "<li class='nav-item'>
                  <a href='#' class='nav-link'>Welcome Guest</a>
                </li>";
        } else {
          echo "<li class='nav-item'>
                  <a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
                </li>";
        }
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a href='./users_area/user_login.php' class='nav-link'>Login</a>
        </li>";
        }
        else{
          echo "<li class='nav-item'>
          <a href='./users_area/logout.php' class='nav-link'>Logout</a>
        </li>";
        }
        ?>
      </ul>
    </nav>
    <!-- third child -->
    <div class="row">
      <div class="col-md-10">
        <!-- products -->
        <div class="row m-1">
          <!-- fetch products -->
          <?php
          get_products();
          get_category_items();
          get_brand_items();
          ?>
        </div>
      </div>
      <div class="col-md-2 bg-secondary p-0 mt-1">
        <!-- brands -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light">
              <h4>Brands</h4>
            </a>
          </li>
          <?php
          get_brands();
          ?>
        </ul>
        <!-- Categories -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light">
              <h4>Categories</h4>
            </a>
          </li>
          <?php
          get_categories();
          ?>
        </ul>
      </div>
    </div>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>