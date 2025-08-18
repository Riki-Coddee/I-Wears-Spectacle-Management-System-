<?php
include '../php/database.php';
$login = false;
$showError = false;
$_SESSION['loggedin'] = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $login_email = $_POST['login_username'];
    $login_password = $_POST['login_password'];
    $remember_me= $_POST['login_remember-me'];
    $sql= "SELECT * FROM `login_table` WHERE `email`='$login_email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        while ($row = mysqli_fetch_assoc($result)) {
            if(password_verify($login_password, $row['password'])){
                $sql= "UPDATE `login_table` SET `remember_me` = '$remember_me' WHERE `email` = '$login_email' "; 
                $login = true;
                session_start();
                $_SESSION['userloggedin'] = true;
                $_SESSION['user']= $row;
                header("Location: ../iwear.php");
            }
            else{
                $showError = " Your password is incorrect.";
            }
        }
       
    }
    else{
        $showError = "Invalid Credentials";
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
    <link rel="stylesheet" href="../Iwear_css/login.css">
    <link rel="stylesheet" href="../Iwear_css/footer.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title>I-Wears - LOGIN</title>
  
</head>

<body>
<?php

include "header.php";
if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show my-10" role="alert">
          <strong>Error!</strong>'.$showError.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if($login){
    echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
          <strong>Success!</strong> You are logged in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
echo'
 <div class="login_overlay active">
<div class="login">
    <form method="post">
        
        <h1 class="login_heading">LOGIN REGISTER</h1>
       <div class="login_username">
         <label for="username">Username</label>
           <input type="email" name="login_username" placeholder="Enter your Email">
       </div>
          
       <div class="login_password">
           <label for="password"> Password</label>
           <input type="password" name="login_password" placeholder="Enter your password">
        </div>

        <div class="login_remember-me">
        <input type="hidden" name="login_remember-me" value="no">
            <input type="checkbox" value="yes" name="login_remember-me">
        <label for="remember-me">Remember me</label>
        </div>
        
        <div class="login_submit_btn">
           <button >Submit</button>
        </div>
        <div class="loginSpan">
        <span><a href="signup.php">Don\'t have an account? Register here.</a></span>
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

