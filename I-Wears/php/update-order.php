<?php

$purchase_order = $_POST['payload'];

include "database.php";

try{

        foreach ($purchase_order as $po) {
            $delivered = (int)$po['qtyDelivered'];
        
        if($delivered > 0){
    $cur_qty_received = (int) $po['qtyReceive'];
        
        $status = $po['status'];
        $row_id = $po['id'];
        $qty_ordered =(int)$po['qtyOrdered'];
        $product_id =(int)$po['productId'];
        $updated_qty_received = $cur_qty_received + $delivered;

        $qty_remaining = $qty_ordered - $updated_qty_received;
        
        $sql = "UPDATE `order_product` SET `quantity_received`='$updated_qty_received',`quantity_remaining`='$qty_remaining',`status`='$status' WHERE `id`='$row_id'"; 
        $result = mysqli_query($conn, $sql);

        // //insert script adding to the order_product_history
        $sql2 ="INSERT INTO `order_product_history` (`order-product-Id`,`qty_received`,`date_received`,`date_updated`) VALUES ($row_id, $delivered, NOW(), NOW());";
        $query = mysqli_query($conn, $sql2);

        //fetch stock data from product 
        $sql3 ="SELECT `stock` FROM `products` WHERE `id`='$product_id' ;";
        $query2 = mysqli_query($conn, $sql3);
        while ($product = mysqli_fetch_assoc($query2)) {
            $cur_stock = (int) $product['stock'];
        } 
           $updated_stock = $cur_stock +  $delivered;
        $sql4 = "UPDATE `products` SET `stock`='$updated_stock' WHERE `id`='$product_id'";
        $query3 = mysqli_query($conn, $sql4);
    }
    else{
        $status = $po['status'];
        $row_id = $po['id'];
        $sql = "UPDATE `order_product` SET `status`='$status' WHERE `id`='$row_id'"; 
        $result = mysqli_query($conn, $sql);
    }

    }
    echo json_encode([
        'status' => true,
        'message' => 'Purchase order updated successfully to the system.'
    ]);
}
catch(PDOException $e){
    echo json_encode([
        'status' => false,
        'message' => 'Error processing your request'
    ]);
}




?>