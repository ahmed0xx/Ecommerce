<?php
include('../includes/connect.php');
@session_start();
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
    <h1 class="text-center mb-4">User Login</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" autocomplete="off" required>
      </div>
      <div class="text-center">
        <input type="submit" value="Login" class="bg-info border-0 p-2 text-light" name="user-login">
        <p class="small font-weight-bold mt-1">Don't have an account? <a href="user_registration.php" class="text-danger">Register</a></p>
      </div>
    </form>
  </div>
</body>

</html>
<?php
if (isset($_POST['user-login'])) {
  $ip = get_ip();
  $name = $_POST['name'];
  $password = $_POST['password'];
  $select_query = "SELECT * FROM `users` WHERE `user_name`='$name'";
  $result = mysqli_query($conn, $select_query);
  $row_data = mysqli_fetch_assoc($result);
  $row = mysqli_num_rows($result);

  // cart item
  $select_cart = "SELECT * FROM `cart_details` WHERE `ip_address`='$ip'";
  $result_cart = mysqli_query($conn, $select_cart);
  $row_cart = mysqli_num_rows($result_cart);

  if ($row > 0) {
    $_SESSION['username'] = $name;
    if (password_verify($password, $row_data['user_password'])) {
      if ($row_cart == 0 and $row == 1) {
        $_SESSION['username'] = $name;
        echo "<script>alert('Login Successful')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
      } else {
        $_SESSION['username'] = $name;
        echo "<script>alert('Login Successful')</script>";
        echo "<script>window.open('payment.php','_self')</script>";
      }
    } else {
      echo "<script>alert('Invalid Credentials')</script>";
    }
  } else {
    echo "<script>alert('Invalid Credentials')</script>";
  }
}


// get ip address

function get_ip()
{
  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
  return $ip_address;
}

?>