<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
$admin = $_SESSION['admin'];
$admin['permission'] = explode (',',$admin['permission']);


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
   <style>
.dashboard-contents_main .box-info{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    grid-gap: 40px;
    margin-top: 40px;
    padding: 0px 20px;
}
.dashboard-contents_main .box-info li{
    padding: 24px;
    background: #7c7a7a;
    border-radius: 20px;
    display: flex;
    align-items: center;
    grid-gap: 24px;
}
.dashboard-contents_main .box-info li .fa-solid{
    width: 80px;
    height: 80px;
    border-radius: 10px;
    font-size: 50px;
    background: rgb(175, 174, 174);
    display: flex;
    justify-content: center;
    align-items: center;
}
.dashboard-contents_main .box-info li:nth-child(1) .fa-solid{
    background: rgb(107, 184, 243);
    
}
.dashboard-contents_main .box-info li:nth-child(1) h3{
    color: rgb(107, 184, 243);;
    
}
.dashboard-contents_main .box-info li:nth-child(2) .fa-solid{
    background: rgb(207, 236, 92);
    
}
.dashboard-contents_main .box-info li:nth-child(2) h3{
    color: rgb(207, 236, 92);
    
}
.dashboard-contents_main .box-info li:nth-child(3) .fa-solid {
    background: rgb(216, 81, 81);
    
    
}
.dashboard-contents_main .box-info li:nth-child(3) h3 {
    color: rgb(212, 69, 69);
    }
.dashboard-contents_main .box-info li:nth-child(4) .fa-solid {
   background: rgb(40, 83, 213);
    }
.dashboard-contents_main .box-info li:nth-child(4) h3 {
    color: rgb(40, 83, 213);
    }
.dashboard-contents_main .box-info li:nth-child(5) .fa-solid{
    background: rgb(76, 219, 138);
}
.dashboard-contents_main .box-info li:nth-child(5) h3{

    color: rgb(76, 219, 138);
  
}
.dashboard-contents_main .box-info li:nth-child(6) .fa-solid{
    background: rgb(174 123 13);
}
.dashboard-contents_main .box-info li:nth-child(6) h3{

    color: rgb(174 123 13);
  
}
.dashboard-contents_main .box-info li:nth-child(7) .fa-solid{
    background: rgb(178 22 153);
}
.dashboard-contents_main .box-info li:nth-child(7) h3{

    color: rgb(178 22 153);
  
}
.dashboard-contents_main .box-info li:nth-child(8) .fa-solid{
    background: #fff;
}
.dashboard-contents_main .box-info li:nth-child(8) h3{

    color: #fff;
  
}
.dashboard-contents_main .box-info li .text h3{
    font-size: 40px;
    padding-left: 35px;
}
.dashboard-contents_main .box-info li .text p{
    font-size: 30px;
    font-weight: bold;
    color: #ffffff;
}
    </style>  
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include "adminpartials/adminsidebar.php"; ?>
        <div class="dashboard-contents_Container">
            
            <?php include "adminpartials/admintopnov.php"; ?>
            <?php
            if(in_array('dashboard_view',$admin['permission'])){
             
            ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                 <ul class="box-info">
                    <li>
                        <i class="fa-solid fa-brands fa-product-hunt"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `products`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total Products</p>
                        </span>
                    </li><li>
                        <i class="fa-solid fa-truck-field"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `suppliers`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total Suppliers</p>
                        </span>
                    </li><li>
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `order_product`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total Purchase Orders</p>
                        </span>
                    </li><li>
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `login_table`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total Users</p>
                        </span>
                    </li><li>
                        <i class="fa-solid fa-lock"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `admin`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total Admins</p>
                        </span>
                    </li>
                    <li>
                        <i class="fa-solid fa-share"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `contact`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total User Messages</p>
                        </span>
                    </li>
                    <li>
                        <i class="fa-solid fa-users"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `usercart`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total User Orders</p>
                        </span>
                    </li>
                    <li>
                        <i class="fa-solid fa-comment"></i>
                        <span class="text">
                            <h3><?php  include "../php/database.php"; 
                                $sql ="SELECT * FROM `feedback`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result) ?></h3>
                            <p>Total User Feedbacks</p>
                        </span>
                    </li>
                 </ul>

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

    <!-- Bootstrap Javascript  -->
    <script src="../javascript/bootstrap-Js/bootstrap.min.js"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.min.js.map"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>

</html>