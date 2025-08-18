<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include '../php/database.php';
$login = false;
$showError = false;
$_SESSION['loggedin'] = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $adminEmail = $_POST['adminUsername'];
    $adminPassword = $_POST['adminPassword'];
    $sql= "SELECT * FROM `admin` WHERE `email`='$adminEmail'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        while ($row = mysqli_fetch_assoc($result)) {
            if(password_verify($adminPassword, $row['password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                    $_SESSION["admin"] = $row;
                   
                header("Location: dashboard.php");
            }
            else{
                $showError = " Your password is not correct.";
            }
        }
        
    }
    else {
        $showError = " Invalid Credentials.";
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
        <!-- CSS LINK  -->
        <link rel="stylesheet" href="adminstylesheet.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
        
        <title>Document</title>
    </head>
    <body>
    <?php
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
      ?>
        <div class="adminpanelcontainer">
            <div class="admin-login-header">
                <h1>I-Wears</h1>
                <h3>Admin Panel</h3>
            </div>
            <div class="admin-login-system">
                <form method="post">
                    <div class="adminInputsConatainer">
                        <label for="">Username</label>
                        <input type="text" name="adminUsername" placeholder="Username"/>
                    </div>
                    <div class="adminInputsConatainer">
                        <label for="">Password</label>
                        <input type="password" name="adminPassword" placeholder="Password"/>
                    </div>
                    <div class="adminLoginBtn">
                        <button>LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    
<!-- Bootstrap Javascript  -->
<script src="../javascript/bootstrap-Js/bootstrap.min.js"></script>
<script src="../javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>
<script>
    if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }
</script>
    </html>
 