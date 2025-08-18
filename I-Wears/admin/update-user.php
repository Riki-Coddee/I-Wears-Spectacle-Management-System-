<?php
include "../php/database.php"; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userid = $_POST['userId'];
    $firstname= $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];

    try{
        $sql="UPDATE `login_table` SET `first_name`='$firstname', `last_name`='$lastname', `email`='$email', `updated_at`=NOW() WHERE `id`='$userid' ";
        $result = mysqli_query($conn, $sql);
        echo json_encode([
            'status' => true,
            'message' => $firstname.' '.$lastname.' Successfully updated.'
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