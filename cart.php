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
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_items(); ?></sup></i></a>
                        </li>
                    </ul>
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
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
          <a href='./users_area/user_login.php' class='nav-link'>Login</a>
        </li>";
                } else {
                    echo "<li class='nav-item'>
          <a href='./users_area/logout.php' class='nav-link'>Logout</a>
        </li>";
                }
                ?>
            </ul>
        </nav>
        <!-- third child -->
        <form action="" method="post">
            <div class="container my-5">
                <div class="row">
                    <table class=" table table-bordered text-center">
                        <!-- fetch cart items -->
                        <?php
                        global $conn;
                        $ip = get_ip();
                        $total_price = 0;
                        $select_query_ip = "SELECT * FROM `cart_details` WHERE `ip_address` = '$ip'";
                        $result_query_ip = mysqli_query($conn, $select_query_ip);
                        $count = mysqli_num_rows($result_query_ip);
                        if ($count > 0) {
                            echo "                        <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while ($rows_ip = mysqli_fetch_array($result_query_ip)) {
                                $product_id = $rows_ip['product_id'];
                                $select_query = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
                                $result_query = mysqli_query($conn, $select_query);
                                while ($rows = mysqli_fetch_array($result_query)) {
                                    $product_price = array($rows['product_price']);
                                    $price_table = $rows['product_price'];
                                    $product_prices = array_sum($product_price);
                                    $total_price += $product_prices;
                                    $product_title = $rows['product_title'];
                                    $product_image1 = $rows['product_image1'];

                        ?>
                                    <tr>
                                        <td><?php echo $product_title; ?></td>
                                        <td><img style="width: 110px; height:110px;" src="./admin-area/product_images/<?php echo $product_image1; ?>" alt=""></td>
                                        <td><?php echo $price_table; ?></td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                                        <td><input type="submit" class="btn btn-danger px-3 text-light" value="Remove item" name="remove_item"></td>
                                    </tr>
                        <?php }
                            }
                        } else {
                            echo "<h2 class='text-danger text-center'>Cart is empty</h2>";
                        } ?>
                        </tbody>
                    </table>
                    <div class="d-flex">
                        <?php
                        $select_query_ip = "SELECT * FROM `cart_details` WHERE `ip_address` = '$ip'";
                        $result_query_ip = mysqli_query($conn, $select_query_ip);
                        $count = mysqli_num_rows($result_query_ip);
                        if ($count > 0) {
                            echo "<h4 class='px-3'>Subtotal: <strong class='text-info'><?php echo $total_price; ?></strong></h4>
                            <button class='btn btn-info px-3 text-light'><a href='index.php' class='text-light text-decoration-none'> Continue shopping</a></button>
                            <button class='btn btn-secondary mx-2 px-3 text-light'><a class='text-light text-decoration-none' href='./users_area/checkout.php'>Checkout</a></button>
                        ";
                        } else {
                            echo "
                            <button class='btn btn-info px-3 text-light'><a class='text-light text-decoration-none' href='index.php'>Continue shopping</a></button>
                        ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>
        <!-- function to remove item -->

        <?php
        function remove1()
        {
            global $conn;
            global $product_id;
            if (isset($_POST['remove_item'])) {
                $delete = "DELETE FROM `cart_details` WHERE `product_id`='$product_id'";
                $run = mysqli_query($conn, $delete);
                if ($run) {
                    echo "<script>window.open('cart.php','_self')</script>";
                }
            }
        }
        function remove()
        {
            global $conn;
            if (isset($_POST['remove_item'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    $delete_query = "DELETE FROM `cart_details` WHERE `product_id`='$remove_id'";
                    $run_query = mysqli_query($conn, $delete_query);
                    if ($run_query) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }

        remove();
        remove1();
        ?>
        <!-- bootstrap js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>