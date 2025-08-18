<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
    include "../php/database.php"; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userid = $_POST['user_id'];
    $firstname= $_POST['f_name'];
    $lastname = $_POST['l_name'];
    try{
        $sql="DELETE FROM `login_table` WHERE `id`='$userid';";
        $result = mysqli_query($conn, $sql);
        echo json_encode([
            'status' => true,
            'message' => $firstname.' '.$lastname.' Successfully Deleted.'
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