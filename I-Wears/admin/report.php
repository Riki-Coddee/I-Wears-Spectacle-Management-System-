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
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="adminstylesheet.css">
      
</head>
<body>
    <di id="dashboardMainContainer">
        <?php include "adminpartials/adminsidebar.php"; ?>
        <div class="dashboard-contents_Container">
            
            <?php include "adminpartials/admintopnov.php"; ?>
            <?php
              if(in_array('report_view',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                     <div id="reportContainer">
                         <div class="reportTypeConatainer">
                            <div class="reportType">
                                <p>Export Products</p>
                                <div class="align-right"> 
                                    <a class="reportExportBtn" href="../php/report_csv.php?report=product">Excel</a>
                                    <a class="reportExportBtn" href="../php/report_pdf.php?report=product">PDF</a>
                                </div>
                            </div>
                            <div class="reportType">
                                <p>Export Suppliers</p>
                                <div class="align-right"> 
                                    <a class="reportExportBtn" href="../php/report_csv.php?report=supplier">Excel</a>
                                    <a class="reportExportBtn" href="../php/report_pdf.php?report=supplier">PDF</a>
                                </div>
                            </div>
                            
                            
                         </div>
                         <div class="reportTypeConatainer">
                            <div class="reportType">
                                <p>Export Deliveries</p>
                                <div class="align-right"> 
                                    <a class="reportExportBtn" href="../php/report_csv.php?report=delivery">Excel</a>
                                    <a class="reportExportBtn" href="../php/report_pdf.php?report=delivery">PDF</a>
                                </div>
                            </div>
                            <div class="reportType">
                                <p>Export Purchase Order</p>
                                <div class="align-right"> 
                                    <a class="reportExportBtn" href="../php/report_csv.php?report=purchase_order">Excel</a>
                                    <a class="reportExportBtn" href="../php/report_pdf.php?report=purchase_order">PDF</a>
                                </div>
                            </div>
                            
                            
                         </div>
                     </div>
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
</html>