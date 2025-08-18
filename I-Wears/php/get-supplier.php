<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "database.php"; 

$id = $_GET['id'];

// Fetch product information
$result = mysqli_query($conn, "SELECT * FROM `suppliers` WHERE `id`='$id'");
$supplierData = mysqli_fetch_assoc($result);

// Fetch supplier information
$statement = "SELECT product_name, products.id FROM products, productsuppliers WHERE productsuppliers.supplier=$id AND productsuppliers.product = products.id";
$query = mysqli_query($conn, $statement);

// Initialize suppliers array
$supplierData['products'] = array();

// Loop through supplier data and add to the suppliers array
while ($data = mysqli_fetch_assoc($query)) {
    $supplierData['products'][] = $data['id'];
}

// Encode the combined array into JSON
echo json_encode($supplierData);
?>
