<?php
include "../php/database.php";
$sId=$_POST['sid'];
$supplierName = $_POST['supplier_name'];
$supplierLocation= $_POST['supplier_location'];
$supplierEmail= $_POST['email'];






try{
    $sql= "UPDATE `suppliers` SET `supplier_name`='$supplierName ', `supplier_location`='$supplierLocation',`email`='$supplierEmail', `updated_at`=NOW() WHERE `id`='$sId' ";
    $result = mysqli_query($conn, $sql);

   //Delete old values
   $deleteOldValue = mysqli_query($conn, "DELETE FROM productsuppliers WHERE supplier=$sId");

   //Loop through suppliers and add record
   //Get Suppliers
  $products = $_POST['products'] ? $_POST['products'] : '';
  if($products){
    foreach($products as $product){
       $sql ="INSERT INTO `productsuppliers` (`supplier`,`product`,`updated_at`,`created_at`) VALUES ($sId, $product, NOW(), NOW());";
       $result = mysqli_query($conn ,$sql);
 }
}


    echo json_encode([
        'status' => true,
        'message' => $supplierName.' updated successfully to the system.'
    ]);
}
catch(PDOException $e){
    echo json_encode([
        'status' => false,
        'message' => 'Error processing your request'
    ]);
}



?>