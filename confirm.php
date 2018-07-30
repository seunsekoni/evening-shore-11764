<?php
  require 'includes/header.php';
  require 'includes/connection.php';
  
  if (!isset($_SESSION['email'])) {
    header("Location: index.php");
  }
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <title>Enimike | Confirmed</title>
 	   <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- bootstrtap stylesheets-       -->
      <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css"/>
     
      <!-- custom stylesheets-      -->
      <link rel="stylesheet" type="text/css" href="css/style.css"/>
   </head>

   <body>
     <!-----   header   ------>
     
    <main>
      <?php
        $id = $_GET['id'];
        $cust_id = $_SESSION['id'];
        foreach ($id as $value) {
          $query = "UPDATE orders SET status='Confirmed' WHERE item_id='$value' AND customer_id='$cust_id'";
          $status = mysqli_query($con, $query) or die('unable to confirm!!!');
        }
      ?>
      <div class="container">
        <div class="jumbotron">
          <h1 class="display-3">Thank you!</h1>
          <p class="lead">Your order is confirmed. Thank you for shopping with us.</p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="market.php" role="button">shop more..</a>
          </p>
        </div>
      </div>
    </main>
     <!--     footer     ---->
     <?php
       require 'includes/footer.php';
      ?>
   </body>
 </html>