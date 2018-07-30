<?php

require 'connection.php';
  if(isset($_SESSION['email'])) {

    header('Location : market.php');
  }
  //get input
  $email = mysqli_real_escape_string($con,$_POST['email']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $hash_password = md5($password);
  else {

    $sel = "SELECT `email`, `password` FROM customers WHERE $email = 'email' AND `password` = '$hash_password'";
    $run_sel = mysqli_query($con, $sel);
    $check_sel = mysqli_num_rows($run_sel);

    if($check_sel ==0 ){
      $chek_sel_err = "Invalid Username or Password";
    }
    else {
      $id = mysqli_insert_id($con);
      $_SESSION['id'] = $id;
      $_SESSION['email'] = $email;
      $_SESSION['lastname'] = $lastname;
      echo "<script>alert('Login Successful!')</script>";
      echo "<script>window.open('market.php', '_self')</script>";
    }


  }



?>