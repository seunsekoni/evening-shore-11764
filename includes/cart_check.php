<?php
  function cart_check($item_id) {

    require 'connection.php';

    $cust_id = $_SESSION['id'];   
    
    $sel = "SELECT * FROM orders WHERE customer_id = '$cust_id' AND item_id = $item_id";
    $run_sel = mysqli_query($con, $sel);
    $check_sel = mysqli_num_rows($run_sel);

    if ($check_sel > 0){

      return true;
    }
    else {
      return false;
    }
  }
?>
