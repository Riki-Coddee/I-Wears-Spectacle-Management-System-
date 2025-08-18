<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
    include "../php/database.php"; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $table= $_POST['table'];

    
    try{
        //Delete old values
        if($table === 'products'){
                    $deleteOldValue = mysqli_query($conn, "DELETE FROM productsuppliers WHERE product=$id");
                    $deleteOldValue2 = mysqli_query($conn, "DELETE FROM order_product WHERE product=$id");
                    $sql= "SELECT `id` FROM `order_product` WHERE `product` =$id;";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $deleteOldValue3 = mysqli_query($conn, "DELETE FROM order_product_history WHERE id=$row");
                    }

        }
        if($table === 'suppliers'){
            $deleteOldValue = mysqli_query($conn, "DELETE FROM productsuppliers WHERE supplier=$id");
        }
       
        $sql="DELETE FROM `$table` WHERE `id`='$id';";
        $result = mysqli_query($conn, $sql);
        echo json_encode([
            'status' => true,
          
        ]);
    }
    catch(PDOException $e){
        echo json_encode([
            'status' => false,
            'message' => 'Error processing your request'
        ]);
    }
}

?>