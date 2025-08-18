<?php

include "../php/database.php"; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pId = $_POST['pid'];
    $uId = $_POST['uid'];
    $productName = $_POST['productName'];
    try{
        $sql="DELETE FROM `wishlist` WHERE `user`='$uId' AND `product`='$pId'";
        $result = mysqli_query($conn, $sql);
        echo json_encode([
            'status' => true,
            'message' => $productName.' '.'is Succesfully deleted from your wishlist.'
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