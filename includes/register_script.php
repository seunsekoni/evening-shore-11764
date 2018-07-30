<?php
  require 'connection.php';

  $firstnameErr = $lastnameErr = $emailErr = $passwordErr = 
  $phoneErr =$addressErr = "";

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
  // if(isset($_POST['submit'])) {

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
          $emailerr = "Invalid Email Format";
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
        $passwordErr = "Password must have at least a lowercase letter<br>
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
    
    $sel = "SELECT email FROM customers where email = '$email'";
    $run_sel = mysqli_query($con, $sel) or die ('Unable to check for duplicates');
    $check_sel = mysqli_num_rows($run_sel);

    if ($check_sel > 0) {
      echo "<div><span class = 'error'> Email already been used by another user</div></span>";
    }
    else {
      echo $ins = "INSERT INTO customers (firstname, lastname, email, password, address, phone) VALUES ('$firstname', '$lastname', '$email', 
              '$hash_password', '$address', '$phone')";
      $run_ins = mysqli_query($con, $ins) or die ('Unable to insert into the database');
      if ($run_ins) {
        $id = mysqli_insert_id($connection);
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