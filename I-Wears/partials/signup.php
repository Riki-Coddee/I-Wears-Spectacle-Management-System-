
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "../php/database.php"; 
$showAlert = false;
$showError = false;
// mysqli_query($conn, "ALTER TABLE `login_table` ADD UNIQUE(`email`)");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['signup_firstname'];
    $lastname = $_POST['signup_lastname'];
    $email = $_POST['signup_username'];
    $password =$_POST['signup_password'];
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $cpassword=$_POST['signup_cpassword'];
    $remember_me= "no";
  
    $result = mysqli_query($conn, "SELECT * FROM `login_table` WHERE `email`='$email' ");
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError = "Username already exists.";
    }
    else {
       
        if(($password == $cpassword) ){
            $sql = "INSERT INTO `login_table` (`first_name`,`last_name`,`email`, `password`, `remember_me`,`created_at`,`updated_at`) VALUES ('$firstname','$lastname','$email', '$hashPassword' , '$remember_me',NOW(), NOW() )";
            $result = mysqli_query($conn ,$sql);
            if($result){
              $showAlert = true;
            } 
           }
           else{
            $showError = "Your passwords don't match.";
         }
    }
    
 
    }
  
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap css  -->
    <link rel="stylesheet" href="../Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="../Iwear_css/bootstrap.min.css.map"> 
    <!-- CSS LINK -->
    <link rel="stylesheet" href="../Iwear_css/iwear.css">
    <link rel="stylesheet" href="../Iwear_css/signup.css">
    <link rel="stylesheet" href="../Iwear_css/footer.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title>Document</title>
</head>

<body>
<?php

include "header.php";
if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
          <strong>Success!</strong> Your account is created and you can logged in now.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show " role="alert">
          <strong>Error!</strong>'. $showError.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
echo'
 <div class="signup_overlay active">
<div class="signup">
    <form id="myForm" method="post">
         <!-- <span id="closesignupBtn">&times;</span> -->
        <h1 class="signup_heading">Sign-Up REGISTER</h1>
        <div class="signup_username">
        <label for="signup_username">First Name</label>
          <input type="text" name="signup_firstname" placeholder="Enter your first name..." required>
      </div>
      <div class="signup_username">
      <label for="signup_lastname">Last Name</label>
        <input type="text" name="signup_lastname" placeholder="Enter your last name...." required>
    </div>
       <div class="signup_username">
         <label for="signup_username">Username</label>
           <input type="email" name="signup_username" placeholder="Enter your Username...." required>
       </div>
          
       <div class="signup_password">
           <label for="password"> Enter Your Password</label>
           <input type="password" name="signup_password" placeholder="Ener your password...." required>
        </div>
        <div class="signup_cpassword">
           <label for="cpassword"> Confirm Your Password</label>
           <input type="password" name="signup_cpassword" placeholder="Confirm your password...." required>
        </div>

        
        
        <div class="signup_submit_btn">
           <button id="signup_submit_id">Submit</button>
        </div>
        

    </form>
</div>
</div>

';
?>





</body>
<!-- Bootstrap Javascript  -->
<script src="../javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="../javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="../javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>

<script>
    if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>

