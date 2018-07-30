<?php
    require 'includes/header.php';
  require 'includes/connection.php';
  if (!isset($_SESSION['email'])) {
    header("Location: login.php");
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Enimike | Cart</title>
	   <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     
  </head>

  <body>
    <!-----   navigation   ------>
    
    <!--       main body      -->
    <main>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 login_form_container">
            <table class="table">
              <thead>
                <tr>
                  <th>Item Number</th>
                  <th>Item Name</th>
                  <th>Price</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $cust_id = $_SESSION['id'];
                  $sel = "SELECT * FROM orders INNER JOIN items ON orders.item_id = items.id WHERE status='Added to cart' AND customer_id='$cust_id'";
                  $run_sel = mysqli_query($con, $sel) or die("can't fetch!!!");
                  if (mysqli_num_rows($run_sel) == 0) {  ?>
                    <tr>
                      <td>You need to place your orders</td>
                      <td><a class="btn btn-primary" href="market.php">Go to the market page!</a></td>
                    </tr>
                  <?php } else {
                      $price = 0;
                      $item_num = 1;
                      $url = "confirm.php?";
                      while ($row = mysqli_fetch_array($run_sel)) {
                        $price = $price + $row['price'];
                        $remove_link = "includes/remove_cart.php?id=".$row['item_id'];
                        $url = $url."id[]=".$row['item_id']."&"; 
                        $payment_url = "payment.php?price=".$row['price'];?>
                        <tr>
                          <td><?php echo $item_num;?></td>
                          <td><?php echo $row['item_name'];?></td>
                          <td>NGN <?php echo $row['price'];?>.00/-</td>
                          <td><a class="btn btn-primary" href="<?php echo $remove_link;?>">Remove</a></td>
                        </tr>
                      <?php $item_num++;
                        }  ?>
                        <tr>
                          <td>&nbsp;</td>
                          <td>Total</td>
                          <td>NGN <?php echo $price;?>.00/-</td>
                          <td><a class="btn btn-primary" href="<?php echo $payment_url;?>">Confirm Order</a></td>
                        </tr>
                    <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- container -->
    </main>
    <!--     footer     ---->
    <?php
      require 'includes/footer.php';
     ?>
  </body>
</html>
