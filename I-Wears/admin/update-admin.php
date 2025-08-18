<?php
include "../php/database.php"; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $adminid = $_POST['adminId'];
    $firstname= $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashadminPassword = password_hash($password, PASSWORD_DEFAULT);
    $permission = $_POST['permissions'];
    if(isset($permission)){
                    if(empty($permission)){
                                    echo json_encode([
                                        'status' => false,
                                        'message' => 'Please make sure permission is set!'
                                    ]);
                    }
        else{
            try{
                $sql = "UPDATE `admin` SET `first_name`='$firstname', `last_name`='$lastname', `email`='$email', `permission`='$permission'";
                if (!empty($hashadminPassword)) {
                    $sql .= ", `password`='$hashadminPassword'";
                }
                $sql .= ", `updated_at`=NOW() WHERE `id`='$adminid'";
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
          
        }
    }
    

?>