<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin'] != true) header("location: iwear.php");
include "../php/database.php"; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $table = isset($_POST['table']) ? $_POST['table'] : '';
    $pId = isset($_POST['pid']) ? $_POST['pid'] : '';
    $uId = isset($_POST['uid']) ? $_POST['uid'] : '';
   if($table == 'usercart'){
    $userId = $_POST['userID'];
    $sql="DELETE FROM `usercart` WHERE `users`='$userId' ";
        $result = mysqli_query($conn, $sql);
        echo json_encode([
            'status' => true,
            'message' => 'Your order has been processed. Kindly check your email for further details.'
        ]);
   }else{
    try{
        $sql="DELETE FROM `usercart` WHERE `users`='$uId' AND `product`='$pId';";
        $result = mysqli_query($conn, $sql);
        echo json_encode([
            'status' => true,
            'message' => 'Your Cart is successfully Deleted.'
        ]);
    }
    catch(PDOException $e){
        echo json_encode([
            'status' => false,
            'message' => 'Error processing your request'
        ]);
    }
}
}

?>