<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "database.php"; 

$id = $_GET['id'];

// Fetch supplier information
$result = mysqli_query($conn, "SELECT supplier_name, suppliers.id FROM suppliers, productsuppliers WHERE productsuppliers.product=$id AND productsuppliers.supplier = suppliers.id");




$supplierData= array();;
// Loop through supplier data and add to the suppliers array
while ( $data= mysqli_fetch_assoc($result)) {
    $supplierData[]= $data;
}

// Encode the combined array into JSON
echo json_encode($supplierData);
?>

