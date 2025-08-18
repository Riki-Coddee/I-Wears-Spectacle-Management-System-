
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
$admin = $_SESSION["admin"];
$admin['permission'] = explode (',',$admin['permission']);
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
include "../php/database.php"; 
$showAlert = false;
$showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['first_name'];
    $lastname= $_POST['last_name'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $hashUserPassword = password_hash($password, PASSWORD_DEFAULT);
  
    
    $result = mysqli_query($conn, "SELECT * FROM `login_table` WHERE `email`='$email';");
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError = true;
    }
    else {
       
            $sql = "INSERT INTO `login_table` (`first_name`,`last_name`,`email`, `password`,`remember_me`,`created_at`,`updated_at`) VALUES ('$firstname','$lastname','$email', '$hashUserPassword','no',NOW(),NOW());";
            $result = mysqli_query($conn ,$sql);
            if($result){
                $showAlert = true;
            } 
            
           
        }
      
    
 
    }
  
    $sql ="SELECT * FROM `login_table`";
    $result = mysqli_query($conn, $sql);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-WEARs - Admin Panel</title>
    <!-- Boostrap css  -->
<link rel="stylesheet" href="../Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="../Iwear_css/bootstrap.min.css.map"> 
    <!-- CSS LINK -->
    <link rel="stylesheet" href="adminstylesheet.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">






</head>
<body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
  
  </div>
</div>



    <div id="dashboardMainContainer">
        <?php include "adminpartials/adminsidebar.php"; ?>
        <div class="dashboard-contents_Container">
            
            <?php include "adminpartials/admintopnov.php"; ?>
            <?php
              if(in_array('user_create',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                    <div class="column column20">
                    <h1 class="adminInsertHeading"><i class="fa fa-plus"></i>Insert User</h1>
                              <div id="adminAddFormConatiner">

                                    <form method="post">
                                        <div class="adFormInputConatiner">
                                           <label for="first_name">First Name</label>
                                           <input type="text" id="first_name" name="first_name">
                                         </div>
                                         <div class="adFormInputConatiner">
                                            <label for="last_name">Last Name</label>
                                             <input type="text" id="last_name" name="last_name">
                                         </div>
                                         <div class="adFormInputConatiner">
                                             <label for="email">Email</label>
                                             <input type="email" id="email" name="email">
                                         </div>
                                         <div class="adFormInputConatiner">
                                             <label for="password">Password</label>
                                             <input type="password" id="password" name="password">
                                         </div>
                                         <button type="submit" id="adFormBtn"><i class="fa fa-plus"></i>Add User</button>
                                    </form>
                              </div>
                        
                     </div>
                        
                    
                    <?php
    if(isset($showAlert) && $showAlert == true){
    echo'
    <div class="addAdminSuccess">
        <p>'.$firstname.' has been successfully added.</p>
    </div>
    ';
    $showAlert = false;
    }
    if($showError){
        echo'
        <div class="addAdminError">
            <p>'.$email.' already exists. </p>
        </div>
        ';
        $showError = false;
    }
    ?>
               
</div>
</div>
                <?php } else{ ?>
                                            <div class="accessdenied">
                                                <img src="../image/access_denied.png" alt="">
                                                <p>Access Denied: Unauthorized Entry.</p> 
                                            </div>
                <?php  } ?>
</div>
</div>
</body>
<script src="js/script.js"></script>
<script src="js/jquery/jquery-script.js"></script>
    <!-- Bootstrap Javascript  -->
    <script src="../javascript/bootstrap-Js/bootstrap.min.js"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.min.js.map"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>

<script>
if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>