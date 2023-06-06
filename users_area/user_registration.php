<?php
// connection file
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>User Registration Form</title>
    <style>
        .container {
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        input[type="submit"] {
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        h1 {
            font-weight: bold;
            font-size: 2.5rem;
            margin-top: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">User Registration Form</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password" autocomplete="off" required>
            </div>
            <div class="text-center">
                <input type="submit" value="Register" class="bg-info border-0 p-2 text-light" name="user-register">
                <p class="small font-weight-bold mt-1">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
            </div>
        </form>
    </div>
    <?php
    function get_ip()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_address;
    }

    if (isset($_POST['user-register'])) {
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $password_hashing = password_hash($password,PASSWORD_DEFAULT);
        $ip = get_ip();
        $select_query = "SELECT * FROM `users` WHERE `user_name`='$user_name' or `user_email`='$user_email'";
        $result = mysqli_query($conn, $select_query);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            echo "<script>alert('The name or email already exist')</script>";
            echo "<script>window.open('user_registration.php','_self')</script>";
        } elseif ($password != $confirm_password) {
            echo "<script>alert('Passwords do not match')</script>";
            echo "<script>window.open('user_registration.php','_self')</script>";
        } else {
            $insert_query = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`, `user_ip`) VALUES ('$user_name','$user_email','$password_hashing','$ip')";
            $sql = mysqli_query($conn, $insert_query);
            if ($sql) {
                echo "<script>alert('Data inserted successfully')</script>";
              
                // selecting cart items
                $select_query_cart = "SELECT * FROM `cart_details` where `ip_address`='$ip'";
                $result_query = mysqli_query($conn, $select_query_cart);
                $num = mysqli_num_rows($result_query);
                if ($num > 0) {
                    $_SESSION['username']=$user_name;
                    echo "<script>alert('You have items in your cart')</script>";
                    echo "<script>window.open('checkout.php','_self')</script>";
                }else{
                    echo "<script>window.open('../index.php','_self')</script>";
                }
            } else {
                die(mysqli_error($conn));
            }
        }





    }
    ?>
</body>

</html>