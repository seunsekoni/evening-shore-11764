<?php
 
  session_start();

?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('includes/style.php'); ?>
  <link rel="stylesheet" type="text/css" href="styles.css"/>

<!--    navigation bar   -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><strong>Enimike Stores</strong></a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navi">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navi" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php
        //If user is logged in
          if (isset($_SESSION['email'])){
         ?>
         <li><a href="../myecommerce/my_cart.php"><strong> <span class="glyphicon glyphicon-shopping-cart"></span>  Cart</strong></a></li>
         <li><a href="../myecommerce/settings.php"><strong> <span class="glyphicon glyphicon-cog"></span>  Settings</strong></a></li>
         <li><a href="../myecommerce/includes/logout.php"><strong> <span class="glyphicon glyphicon-log-out"></span>  Logout</strong></a></li>
        <?php
          }else {
            // If user is not logged in
         ?>
         <li><a href="login.php"><strong> <span class="glyphicon glyphicon-log-in"></span>  Login</strong></a></li>
         <li><a href="register.php"><strong> <span class="glyphicon glyphicon-user"></span>  Register</strong></a></li>
        <?php
          }
         ?>
      </ul>
    </div>
  </div>
</nav>
