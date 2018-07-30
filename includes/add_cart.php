<?php
  session_start();
  require 'connection.php';
  //store data from url and session
  $cust_id = $_SESSION['id'];
  $item_id = $_GET['id'];
  //create query
 echo $query = "INSERT INTO orders (customer_id,item_id,`status`) VALUES ('$cust_id','$item_id','Added to cart')";
  $status = mysqli_query($con, $query) or die('unable to add!!!');
  header("Location: ../market.php");


?>