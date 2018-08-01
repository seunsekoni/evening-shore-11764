<?php
require 'includes/header.php';
 include('includes/connection.php') ; 
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to our market place</title>
    <?php include('includes/style.php') ; ?>
    
<body>
    <?php
      
      require 'includes/cart_check.php';
     ?>
     <!-- main body -->
     <main>
        <div class = "container">
            <div class = "jumbotron">
                <div class = "row text-center">
                    <h1>Welcome to our Store!</h1>
                    <p>Shopping made easy. Start placing your orders</p>
                </div>
            </div> <!--jumbotron  -->
            <div class = "row text-center">
            <form method = "market.php" action = "POST">
                <?php
                    $sel = "SELECT * FROM items";
                    $run_sel = mysqli_query($con, $sel);
                    while ($row = mysqli_fetch_assoc($run_sel)) {
                        ?>

                        <div class = "col-md-3 col-sm-4 col-xs-6">
                        <div class = "thumbnail">
                        <img src="images/<?php echo $row['image_name']?>" alt="<?php echo $row['image_name']?>"/>
                        <div class="caption row text-center">
                            <h3><?php echo $row['item_name']; ?></h3>
                            <p>price NGN<?php echo $row['price']; ?>.00</p>
                        <?php
                            if (isset($_SESSION['email'])) {
                                if (cart_check($row['id'])) { ?>
                                <a class="btn btn-default btn-block disabled" href="#">Added to cart</a>
                                <?php } else {
                                $add = "includes/add_cart.php?id=".$row['id']; ?>
                                <a class="btn btn-primary btn-block" href="<?php echo $add;?>">Add to cart</a>
                                <?php }
                                } else { ?>
                                <a class="btn btn-primary btn-block" href="login.php">Buy Now </a>
                    <?php
                        }  ?>
                  </div>
                </div>
              </div><!-- column -->
          <?php
            }  ?>
          </form>
        </div><!--row -->
      </div><!-- container -->
    </main>
    <!--     footer     ---->
    <?php
      require 'includes/footer.php';
     ?>
  </body>
</html>
           