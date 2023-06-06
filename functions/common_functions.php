<?php
// include connection
include( './includes/connect.php' );

// getting products

function get_products() {
    if ( !isset( $_GET[ 'category' ] ) ) {
        if ( !isset( $_GET[ 'brand' ] ) ) {

            global $conn;
            $selet_query = 'SELECT * FROM `products` order by rand()';
            $result_query = mysqli_query( $conn, $selet_query );
            while ( $row = mysqli_fetch_assoc( $result_query ) ) {
                $product_id = $row[ 'product_id' ];
                $product_title = $row[ 'product_title' ];
                $product_description = $row[ 'product_desrciption' ];
                $product_image1 = $row[ 'product_image1' ];
                $product_price = $row[ 'product_price' ];
                $category_id = $row[ 'category_id' ];
                $brand_id = $row[ 'brand_id' ];

                echo "
            <div class='col-md-4 mb-1'>

            <div class='card'>
              <img src='./admin-area/product_images/$product_image1' class='card-img-top' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='./product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>

          </div>
          ";
            }
        }
    }
}

// getting category items

function get_category_items() {
    if ( isset( $_GET[ 'category' ] ) ) {
        $cat_id = $_GET[ 'category' ];
        global $conn;
        $selet_query = "SELECT * FROM `products` WHERE `category_id`='$cat_id'";
        $result_query = mysqli_query( $conn, $selet_query );
        $num_rows = mysqli_num_rows( $result_query );
        if ( $num_rows == 0 ) {
            echo "<h1 class='text-center text-danger'>No stock for this category</h1>";
        }
        while ( $row = mysqli_fetch_assoc( $result_query ) ) {
            $product_id = $row[ 'product_id' ];
            $product_title = $row[ 'product_title' ];
            $product_description = $row[ 'product_desrciption' ];
            $product_image1 = $row[ 'product_image1' ];
            $product_price = $row[ 'product_price' ];
            $category_id = $row[ 'category_id' ];
            $brand_id = $row[ 'brand_id' ];

            echo "
            <div class='col-md-4 mb-1'>

            <div class='card'>
              <img src='./admin-area/product_images/$product_image1' class='card-img-top' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='./product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>

          </div>
          ";
        }
    }
}

// getting brand items

function get_brand_items() {
    if ( isset( $_GET[ 'brand' ] ) ) {
        $brand_item_id = $_GET[ 'brand' ];
        global $conn;
        $selet_query = "SELECT * FROM `products` WHERE `brand_id`='$brand_item_id'";
        $result_query = mysqli_query( $conn, $selet_query );
        $num_rows = mysqli_num_rows( $result_query );
        if ( $num_rows == 0 ) {
            echo "<h1 class='text-center text-danger'>This brand is not available for service</h1>";
        }
        while ( $row = mysqli_fetch_assoc( $result_query ) ) {
            $product_id = $row[ 'product_id' ];
            $product_title = $row[ 'product_title' ];
            $product_description = $row[ 'product_desrciption' ];
            $product_image1 = $row[ 'product_image1' ];
            $product_price = $row[ 'product_price' ];
            $category_id = $row[ 'category_id' ];
            $brand_id = $row[ 'brand_id' ];

            echo "
            <div class='col-md-4 mb-1'>

            <div class='card'>
              <img src='./admin-area/product_images/$product_image1' class='card-img-top' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='./product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>

          </div>
          ";
        }
    }
}

// displaying brands

function get_brands() {
    global $conn;
    $select_brands = 'SELECT * FROM `brands`';
    $result_brands = mysqli_query( $conn, $select_brands );
    while ( $row_data = mysqli_fetch_assoc( $result_brands ) ) {
        $brand_title = $row_data[ 'brand-title' ];
        $brand_id = $row_data[ 'brand-id' ];
        echo "<li class='nav-item'>
        <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a></li>";
    }
}

// displaying categories

function get_categories() {
    global $conn;
    $select_category = 'SELECT * FROM `categories`';
    $result_category = mysqli_query( $conn, $select_category );
    while ( $row_data2 = mysqli_fetch_assoc( $result_category ) ) {
        $category_title = $row_data2[ 'category_title' ];
        $category_id = $row_data2[ 'category_id' ];
        echo "<li class='nav-item'>
        <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
    </li> ";
    }
}

// searching product

function search_product() {
    global $conn;
    if ( isset( $_GET[ 'search_product' ] ) ) {
        $product = $_GET[ 'search_product' ];

        $search_query = "SELECT * FROM `products` Where `product_keywords` LIKE '%$product%'";
        $result_query = mysqli_query( $conn, $search_query );
        $num_rows = mysqli_num_rows( $result_query );
        if ( $num_rows == 0 ) {
            echo "<h1 class='text-center text-danger'>No results match</h1>";
        } else {
            while ( $row = mysqli_fetch_assoc( $result_query ) ) {
                $product_id = $row[ 'product_id' ];
                $product_title = $row[ 'product_title' ];
                $product_description = $row[ 'product_desrciption' ];
                $product_image1 = $row[ 'product_image1' ];
                $product_price = $row[ 'product_price' ];
                $category_id = $row[ 'category_id' ];
                $brand_id = $row[ 'brand_id' ];

                echo "
            <div class='col-md-4 mb-1'>

            <div class='card'>
              <img src='./admin-area/product_images/$product_image1' class='card-img-top' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='./product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>

          </div>
          ";
            }
        }
    }
}

// product details

function product_details() {
    if ( isset( $_GET[ 'product_id' ] ) ) {
        $id = $_GET[ 'product_id' ];
        global $conn;
        $search_query = "SELECT * FROM `products` Where `product_id`= '$id'";
        $result_query = mysqli_query( $conn, $search_query );
        while ( $row = mysqli_fetch_assoc( $result_query ) ) {
            $product_id = $row[ 'product_id' ];
            $product_title = $row[ 'product_title' ];
            $product_description = $row[ 'product_desrciption' ];
            $product_image1 = $row[ 'product_image1' ];
            $product_image2 = $row[ 'product_image2' ];
            $product_image3 = $row[ 'product_image3' ];
            $product_price = $row[ 'product_price' ];
            $category_id = $row[ 'category_id' ];
            $brand_id = $row[ 'brand_id' ];

            echo"
    <div class='row'>
        <div class='col-md-4 mb-1'>
            <div class='card'>
              <img src='./admin-area/product_images/$product_image1' class='card-img-top' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='index.php' class='btn btn-secondary'>Go Home</a>
              </div>
            </div>
          </div>
          <div class='col-md-4' >
          <img src='./admin-area/product_images/$product_image2' class='card-img-top' alt='...'>
          </div>
          <div class='col-md-4' >
          <img src='./admin-area/product_images/$product_image3' class='card-img-top' alt='...'>
          </div>
    </div>
    ";
        }
    }
}

// get ip address

function get_ip() {
    if ( isset( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {
        $ip_address = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
    } else {
        $ip_address = $_SERVER[ 'REMOTE_ADDR' ];
    }
    return $ip_address;
}

// cart function

function cart() {
    if ( isset( $_GET[ 'add_to_cart' ] ) ) {
        global $conn;
        $ip = get_ip();
        $product_id = $_GET[ 'add_to_cart' ];
        $selet_query = "SELECT * FROM `cart_details` WHERE `ip_address` = '$ip' and 
    `product_id`='$product_id'";
        $result_query = mysqli_query( $conn, $selet_query );
        $num_rows = mysqli_num_rows( $result_query );
        if ( $num_rows > 0 ) {
            echo"<script>alert('This item is already added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_quert = "INSERT INTO `cart_details` (`product_id`,`ip_address`) 
          VALUES ('$product_id','$ip')";
            $result_query = mysqli_query( $conn, $insert_quert );
            echo"<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";

        }
    }
}

// num cart items

function cart_items() {
    global $conn;
    $ip = get_ip();
    $selet_query = "SELECT * FROM `cart_details` WHERE `ip_address` = '$ip'";
    $result_query = mysqli_query( $conn, $selet_query );
    $num_rows = mysqli_num_rows( $result_query );
    echo $num_rows;
}

// getting total price

function total_price() {
    global $conn;
    $ip = get_ip();
    $total_price = 0;
    $select_query_ip = "SELECT * FROM `cart_details` WHERE `ip_address` = '$ip'";
    $result_query_ip = mysqli_query( $conn, $select_query_ip );
    while( $rows_ip = mysqli_fetch_array( $result_query_ip ) ) {
        $product_id = $rows_ip[ 'product_id' ];
        $select_query_price = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
        $result_query_price = mysqli_query( $conn, $select_query_price );
        while( $rows_price = mysqli_fetch_array( $result_query_price ) ) {
            $product_price = array( $rows_price[ 'product_price' ] );
            $product_prices = array_sum( $product_price );
            $total_price += $product_prices;
        }
    }
    echo $total_price;
}

