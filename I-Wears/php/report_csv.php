<?php
session_start();
error_reporting(E_ALL);
$type = $_GET['report'];
$file_name = '.xls';

$mapping_filenames=[
    'supplier' => 'Supplier Report',
    'product' => 'Product Report',
    'delivery' => 'Delivery Report',
    'purchase_order' => 'Purchase Report'
];
$file_name = $mapping_filenames[$type].'.xls';


header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");

// pull data from database
include "database.php"; 


//Product Export
if ($type === 'product') {
    $sql = "SELECT products.id,products.product_name, admin.first_name, admin.last_name, products.description, products.stock, products.created_by, products.created_at, products.updated_at FROM products INNER JOIN admin ON products.created_by = admin.id ORDER BY products.created_at DESC";
    $result = mysqli_query($conn, $sql);
    $is_header = true;
    // Check if the query was successful
    if ($result) {
        // Fetch the rows and store them in an array
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        // Process the fetched data using foreach loop
             foreach ($products as $product) {
                $product['created_by'] = $product['first_name'].' '.$product['last_name'];
                unset($product['frist_name'],$product['last_name']);
                     if($is_header){
                         $row2 = array_keys($product);
                         echo implode("\t",$row2)."\n";
                         $is_header = false;
                         
                        }
                     array_walk($product, function(&$str){
                        $str = preg_replace("/\t/", "\\t", $str);
                        $str = preg_replace("/\r?\n/", "\\n", $str);
                        if(strstr($str, '"'))$str = '"'.str_replace('"', '""',$str).'"';

                     });

                        echo implode("\t", $product)."\n";
                     
                           

                              }
    } 
}

//Supplier Export
if ($type === 'supplier') {
    $sql = "SELECT  suppliers.id as sid ,suppliers.supplier_name, admin.first_name, admin.last_name, suppliers.supplier_location, suppliers.email, suppliers.created_by, suppliers.created_at as createdat FROM suppliers INNER JOIN admin ON suppliers.created_by = admin.id ORDER BY suppliers.created_at DESC";
    $result = mysqli_query($conn, $sql);
    $is_header = true;
    // Check if the query was successful
    if ($result) {
        // Fetch the rows and store them in an array
        $suppliers = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $suppliers[] = $row;
        }

        // Process the fetched data using foreach loop
             foreach ($suppliers as $supplier) {
                $supplier['created_by'] = $supplier['first_name'].' '.$supplier['last_name'];
                unset($supplier['first_name'],$supplier['last_name']);
                     if($is_header){
                         $row2 = array_keys($supplier);
                         echo implode("\t",$row2)."\n";
                         $is_header = false;
                         
                        }
                     array_walk($supplier, function(&$str){
                        $str = preg_replace("/\t/", "\\t", $str);
                        $str = preg_replace("/\r?\n/", "\\n", $str);
                        if(strstr($str, '"'))$str = '"'.str_replace('"', '""',$str).'"';

                     });

                        echo implode("\t", $supplier)."\n";
                     
                           

                              }
    } 
}

//Purchase Order Export
if ($type === 'purchase_order') {
    $sql = "SELECT  order_product.id,admin.first_name, admin.last_name, order_product.quantity_ordered, order_product.quantity_received, order_product.quantity_remaining, order_product.status, order_product.batch, suppliers.supplier_name, order_product.created_at as 'order product created at' FROM order_product 
    INNER JOIN admin ON order_product.created_by = admin.id
    INNER JOIN suppliers ON order_product.supplier = suppliers.id ORDER BY order_product.batch DESC";
    $result = mysqli_query($conn, $sql);
    $is_header = true;
    // Check if the query was successful
    if ($result) {
        // Fetch the rows and store them in an array
        $order_products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $order_products [] = $row;
        }
        
        //sorting using batch numin array
        $pos=[];
        foreach ($order_products as $order_product) {
           $pos[$order_product['batch']][] = $order_product;
        }
      
        // Process the fetched data using foreach loop
        foreach ($pos as $order_products) {
            foreach ($order_products  as $order_product) {
                $order_product['created_by'] = $order_product['first_name'].' '.$order_product['last_name'];
                unset($order_product['first_name'],$order_product['last_name']);
                     if($is_header){
                         $row2 = array_keys($order_product);
                         echo implode("\t",$row2)."\n";
                         $is_header = false;
                         
                        }
                        
                     array_walk($order_product, function(&$str){
                        $str = preg_replace("/\t/", "\\t", $str);
                        $str = preg_replace("/\r?\n/", "\\n", $str);
                        if(strstr($str, '"'))$str = '"'.str_replace('"', '""',$str).'"';

                     });

                        echo implode("\t", $order_product)."\n";
                     
                           

                              }
                              echo "\n";
        }
            
    } 
}


//Delivery Export
if ($type === 'delivery') {
    $sql = "SELECT date_received, qty_received, first_name, last_name, suppliers.supplier_name, products.product_name, batch,order_product.created_by  FROM order_product_history, order_product, suppliers, products, admin 
    WHERE order_product_history.`order-product-Id` = order_product.id
    AND order_product.created_by = admin.id
    AND order_product.supplier = suppliers.id
    AND order_product.product = products.id
    ORDER BY order_product.batch DESC";
    $result = mysqli_query($conn, $sql);
    $is_header = true;
    // Check if the query was successful
    if ($result) {
        // Fetch the rows and store them in an array
        $deliveries = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $deliveries[] = $row;
        }
      
        //sorting using batch numin array
        $deliver_by_batch=[];
        foreach ($deliveries as $delivery) {
           $deliver_by_batch[$delivery['batch']][] = $delivery;
        }
       
        // Process the fetched data using foreach loop
        foreach ($deliver_by_batch as $deliveries) {
            foreach ($deliveries  as $delivery) {
                $delivery['created_by'] = $delivery['first_name'].' '.$delivery['last_name'];
                unset($delivery['first_name'],$delivery['last_name']);
                     if($is_header){
                         $row2 = array_keys($delivery);
                         echo implode("\t",$row2)."\n";
                         $is_header = false;
                         
                        }
                        
                     array_walk($delivery, function(&$str){
                        $str = preg_replace("/\t/", "\\t", $str);
                        $str = preg_replace("/\r?\n/", "\\n", $str);
                        if(strstr($str, '"'))$str = '"'.str_replace('"', '""',$str).'"';

                     });

                        echo implode("\t", $delivery)."\n";
                     
                           

                              }
                              echo "\n";
        }
            
    } 
}


?>