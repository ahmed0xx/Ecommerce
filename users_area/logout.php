<?php

session_start();
session_unset();
session_destroy();
echo "<script>alert('You are successfully logged out')</script>";
echo "<script>window.open('../index.php','_self')</script>";
?>