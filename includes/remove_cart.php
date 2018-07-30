<?php
  session_start();
  require 'connection.php';
  
  $cust_id = $_SESSION['id'];
  $item_id = $_GET['id'];

  echo $sel = "DELETE FROM orders where customer_id = '$cust_id' AND item_id = '$item_id'";
  $run_sel = mysqli_query($con, $sel) or die ('unable to delete');
  header('Location: ../my_cart.php');




?>