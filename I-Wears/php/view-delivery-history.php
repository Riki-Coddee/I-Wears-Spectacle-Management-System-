<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "../php/database.php"; 
$id = $_GET['id'];
$sql = "SELECT * FROM `order_product_history` WHERE `order-product-Id` = '$id' ";
$result = mysqli_query($conn, $sql);
$rows= [];
while ($row = mysqli_fetch_assoc($result)) {
   $rows[] = $row;
}
echo json_encode($rows);
?>