<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "database.php"; 
$products = $_POST['product_name'];
$qty = array_values($_POST['quantity']);

$post_data_arr = [];
$batch = time();
$admin = $_SESSION['admin'];
$value = $admin['id'];

foreach ($products as $key => $pId) {
    if (isset($qty[$key])) {
       $post_data_arr[$pId] = $qty[$key];
}
}


 try{
    foreach ($post_data_arr as $pId => $suppliers_qty) {
    foreach ($suppliers_qty as $sId => $qty) {
        $qtyString = (int)implode('', $qty);
      
        $sql ="INSERT INTO `order_product` (`supplier`,`product`,`quantity_ordered`,`status`,`batch`,`created_by`,`updated_at`,`created_at`) VALUES ($sId, $pId, $qtyString,'ordered',$batch, $value, NOW(), NOW());";
                     $result = mysqli_query($conn ,$sql);
    }

 }

    $_SESSION['showAlert'] = true;
}
catch(PDOException $e){
$_SESSION['showError'] = true;
}
header("location: ../admin/product-order.php");
?>