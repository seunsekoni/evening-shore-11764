<?php
require 'includes/header.php';
require 'includes/connection.php';
if (isset($_SESSION['email'])) {
  header("Location: product.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Enimike Store | Registration</title>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
</head>
<?php
 $firstnameErr = $lastnameErr = $emailErr = $passwordErr = 
 $phoneErr =$addressErr = $check_err = "";

 $firstname = $lastname = $email = $password = 
 $phone = $address = "";


 function strip_data($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }

$formvalid = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //if(isset($_POST['submit'])) {

   if (empty($_POST['firstname'])) {
     $firstnameErr = "First Name is Required";
     $formvalid = false;
   }
   else {
     $firstname = strip_data($_POST['firstname']);
    // $pattern = "^[a-zA=z]*$";
     if (!preg_match("/^[a-zA=z]*$/", $firstname)) {
       $firstnameErr = "Only letters and whitespaces allowed";
       $formvalid = false;
     }
   }


   
   if (empty($_POST['lastname'])) {
     $lastnameErr = "Last Name is Required";
     $formvalid = false;
   }
   else {
     $lastname = strip_data($_POST['lastname']);
     $pattern = "/^[a-zA=z]*$/";
     if (!preg_match($pattern, $lastname)) {
       $lastnameErr = "Only letters and whitespaces allowed";
       $formvalid = false;
     }
   }
   

  
   if (empty($_POST['email'])) {
     $emailErr = "Email is Required";
     $formvalid = false;
   }
   else {
     $email = strip_data($_POST['email']);
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $emailerr = "<h5>Invalid Email Format</h5>";
         $formvalid = false;
     }
   }
  

  
   if (empty($_POST['password'])) {
     $passwordErr = "Password is Required";
     $formvalid = false;
   }
   else {
     $password = strip_data($_POST['password']);
     $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$/";
     if (!preg_match($pattern, $password)) {
       $passwordErr = "<br>Password must have at least a lowercase letter<br>
                            Password must have at least a block letter<br>
                            Password must have at least a number<br>
                            Password must have at least a special letter<br>
                            Password must be at least 8 characters<br>
                            Password must be at most 20 characters";
       $formvalid = false;
       
     }
   }
   $hash_password = md5($password);


   
   if (empty($_POST['phone'])) {
     $phoneErr = "Phone Number is Required";
     $formvalid = false;
   }
   else {
     $phone = strip_data($_POST['phone']);
     $pattern = "/^[0-9]{10,11}$/";
     if (!preg_match($pattern, $phone)) {
       $phoneErr = "Minimum of 10 and Maximum of 11 numbers";
       $formvalid = false;
     }
   }


  
   if (empty($_POST['address'])) {
     $addressErr = "Address is Required";
     $formvalid = false;
        }
   else {
     $address = strip_data($_POST['address']);
   }


   if ($formvalid) {
   
     $sel = "SELECT * FROM customers where `email` = '$email'";
   $run_sel = mysqli_query($con, $sel) or die ('Unable to check for duplicates');
   $check_sel = mysqli_num_rows($run_sel);

   if ($check_sel > 0) {
     $check_err = "Email address has already been used by another user, please use another email address.";
   }
   else {
     echo $ins = "INSERT INTO customers (`firstname`, `lastname`, `email`, `password`, `address`, `phone`) VALUES ('$firstname', '$lastname', '$email', 
             '$hash_password', '$address', '$phone')";
     $run_ins = mysqli_query($con, $ins) or die ('Unable to insert into the database');
     if ($run_ins) {
       $id = mysqli_insert_id($con);
       $_SESSION['id'] = $id;
       $_SESSION['email'] = $email;
       $_SESSION['lastname'] = $lastname;
       echo "<script>alert('Registration Successful!')</script>";
       echo "<script>window.open('market.php', '_self')</script>";
     }
   }
 }

} 

?>
<body>
  <!--       main body      -->
  <main>
    <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 form_container">
            <h2>Registration</h2>
            <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name"/>
                <span class ="error">* <?php echo $firstnameErr; ?></span>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name"/>
                <span class ="error">* <?php echo $lastnameErr; ?></span>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <span class ="error">* <?php echo $emailErr; ?></span>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class ="error">* <?php echo $passwordErr; ?></span>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="phone" placeholder="Phone">
                <span class ="error">* <?php echo $phoneErr; ?></span>
              </div>
              <!-- <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="City">
              </div> -->
              <div class="form-group">
                <textarea class="form-control" class="form-control" name="address" placeholder="Address"></textarea>
                <span class ="error">* <?php echo $addressErr; ?></span>
              </div>
              <button type="submit" class="btn btn-primary" name = "submit">Register</button><br>
              <span class = "error"><?php echo $check_err; ?> </span>

            </form>
          </div>
        </div>
    </div>
  </main>
  <!--     footer     ---->
  <?php
    require 'includes/footer.php';
    
   
  
//}
  ?>
   
</body>
</html>