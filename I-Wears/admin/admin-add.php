
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
$admin = $_SESSION['admin'];
$admin['permission'] = explode (',',$admin['permission']);
include "../php/database.php"; 
$showAlert = false;
$showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['first_name'];
    $lastname= $_POST['last_name'];
    $email= $_POST['email'];
    $permission = $_POST['permissions'];
    $password= $_POST['password'];
    $hashAdminPassword  = password_hash($password, PASSWORD_DEFAULT);

    if(isset($permission)){
        if(empty($permission)){
        $showError = "Please make sure permission is set!";
        }
        else{
            $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email`='$email';");
            $numExistRows = mysqli_num_rows($result);
            if($numExistRows > 0){
                $showError = $email." "."already exists.";
            }
            else {
               
                    $sql = "INSERT INTO `admin` (`first_name`,`last_name`,`email`, `password`,`created_at`,`updated_at`,`permission`) VALUES ('$firstname','$lastname','$email', '$hashAdminPassword',NOW(),NOW(),'$permission');";
                    $result = mysqli_query($conn ,$sql);
                    if($result){
                       
                      $showAlert = true;
                    } 
                    
                    
                }
                $showError =false;
            
         
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
              if(in_array('admin_create',$admin['permission'])){
                  ?>
                  <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                                    <div class="row">
                                                <div class="column column20">
                                                            <h1 class="adminInsertHeading"><i class="fa fa-plus"></i>Insert Admin</h1>
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
                                                                                <input type="hidden" name="permissions" id="adminPermissions">
                                                                                <?php include 'adminpartials/permission.php' ?>
                                                                                <button type="submit" id="adFormBtn"><i class="fa fa-plus"></i>Add Admin</button>
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
            <p>'.$showError.'  </p>
        </div>
        ';
        $showError = false;
    }
    ?>
               
             </div>
         </div>
         <?php
              } else{
         ?>
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
<script defer src="../javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="../javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>



    
<script>
    if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }




 function loadScript(){
    this.permissions = [];
    this.initialize = function () {
        this.registerEvents();
    },
    this.registerEvents = function(){
       document.addEventListener("click", function(e){
        let target = e.target;

        //Check if class name - moduleFunc - is clicked
        if(target.classList.contains('moduleFunc')){
            //Get Value
            let permissionName = target.dataset.value;
            if(target.classList.contains("permissionActive")){
                target.classList.remove("permissionActive");
                
                //Remove from array 
                script.permissions = script.permissions.filter((name)=>{
                    return name !== permissionName;
                })
            }
            else {
                target.classList.add("permissionActive");
                script.permissions.push(permissionName);
            }
             
            //update the hidden element
            document.getElementById("adminPermissions").value = script.permissions.join(",");
            
         }
     });
 }
}

var script = new loadScript;
script.initialize();
</script>
</html>