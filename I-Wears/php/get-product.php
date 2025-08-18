<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "database.php"; 

$id = $_GET['id'];

// Fetch product information
$result = mysqli_query($conn, "SELECT * FROM `products` WHERE `id`='$id'");
$productData = mysqli_fetch_assoc($result);

// Fetch supplier information
$statement = "SELECT supplier_name, suppliers.id FROM suppliers, productsuppliers WHERE productsuppliers.product=$id AND productsuppliers.supplier = suppliers.id";
$query = mysqli_query($conn, $statement);

// Initialize suppliers array
$productData['suppliers'] = array();

// Loop through supplier data and add to the suppliers array
while ($data = mysqli_fetch_assoc($query)) {
    $productData['suppliers'][] = $data['id'];
}

// Encode the combined array into JSON
echo json_encode($productData);
?>
