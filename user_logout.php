<?php 
session_start();
unset($_SESSION["user_type"]);
unset($_SESSION["user_name"]);

session_destroy();
echo "<script>window.open('index.php','_self')</script>";
?>