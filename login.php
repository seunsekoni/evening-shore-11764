<?php
 require 'includes/header.php';
 require 'includes/connection.php';
 if (isset($_SESSION['email'])) {
  header("Location: market.php");
  
}
?>
<html>
<head>
  <title>Enimike Stores | Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<style>
    .error {
      color: #FF0000;
    }
  </style>
<body>
  <!--    navigation bar   -->
  <?php
    $check_sel_err = "";
    $checkEmailErr = $checkPassErr = "";
    $email = $password = "";


    function strip_data($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    $form_valid = true;
//if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['submit'])) {

   if (empty($_POST['email'])) {
     $checkEmailErr = "Email Field can't be empty";
     $form_valid = false;
   }
   else {
    $email = strip_data($_POST['email']);
   }
    //get input
  if (empty($_POST['password'])) {
    $checkPassErr = "Password field can't be empty";
    $form_valid = false;
  }
  else {
  $password = strip_data($_POST['password']);
  $hash_password = md5($password);
  }

  if ($form_valid){

    $sel = "SELECT * FROM customers WHERE `email` = '$email' AND `password` = '$hash_password'";
    $run_sel = mysqli_query($con, $sel);
    $check_sel = mysqli_num_rows($run_sel);

    if($check_sel == 0 ){
		$check_sel_err = "Invalid Username/Password";
		$form_valid = false;
    }
    else {
      $result_arr = mysqli_fetch_array($run_sel);
    if ($hash_password == $result_arr['password']) {
      //set Session
      $_SESSION['id'] = $result_arr['id'];
      $_SESSION['email'] = $result_arr['email'];
      $_SESSION['lastname'] = $result_arr['lastname'];
      echo "<script>alert('Login Successful!')</script>";
      echo "<script>window.open('market.php', '_self')</script>";
    } else {
      header("Location: login.php");
      
    } 
    }
  }
  }
   ?>
  <!--       main body      -->
  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 login_form_container">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">LOGIN</h3>
            </div>
            <div class="panel-body">
              <p class="text-warning">Login to make a purchase</p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-group">
                  <span class = "error"><?php echo $check_sel_err; ?></span>
                  <input type="email" class="form-control" name="email" placeholder="Email"/>
                  <span class = "error">*<?php echo $checkEmailErr; ?></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" >
                  <span class = "error">*<?php echo $checkPassErr; ?></span>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
              </form>
            </div>
            <div class="panel-footer">
              <p class="text-info">Don't have an account? <a href="register.php"><b class="text-primary">Register</b></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!--     footer     ---->
  <?php
    require 'includes/footer.php';
   ?>
</body>
</html>