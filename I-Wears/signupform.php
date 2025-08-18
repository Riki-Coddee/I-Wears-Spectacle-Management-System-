
<?php session_start();
include "php/database.php"; 
$showAlert = false;
$showError = false;
mysqli_query($conn, "ALTER TABLE `login_table` ADD UNIQUE(`email`)");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['signup_username'];
    $password =$_POST['signup_password'];
    $cpassword=$_POST['signup_cpassword'];
    $remember_me= "no";
    $username_already_exist = false;
    
    if(($password == $cpassword) && $username_already_exist == false){
        $sql = "INSERT INTO `login_table` (`email`, `password`, `remember_me`) VALUES ('$email', '$password' , '$remember_me' )";
        $result = mysqli_query($conn ,$sql);
        if($result){
          $showAlert = true;
        } 
       }
       else{
        $showError = "Your password doesn't matched";
     }
    }
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
   
?>
