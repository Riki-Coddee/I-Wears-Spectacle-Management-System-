<?php
session_start();
error_reporting(E_ALL);

ini_set("display_errors", 1);
include "database.php"; 
include ('table_columns.php');
$table_name = $_SESSION['table'];
$columns = $table_columns_mapping[$table_name];

$db_arr =[];
$admin = $_SESSION['admin'];
foreach ($columns as $column) {
   if(in_array($column, ['created_at','updated_at'])) $value = date('Y-m-d H:i:s');
   elseif($column == 'created_by') $value = $admin['id'];
   elseif ($column == 'stock') {
      $value = 0;
   }
   elseif($column == 'img'){
   
      $target_dir = "../admin/uploads/";
      $file_data = $_FILES[$column];
      $value = NULL;
      if($file_data['tmp_name'] != ''){
      
      $file_name = $file_data['name'];
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
      $file_name ='product-'.time().'.'.$file_ext;
      $check = getimagesize($file_data['tmp_name']);
      if($check){ 
           if(move_uploaded_file($file_data["tmp_name"], $target_dir.$file_name)){$value = $file_name;}
          
      }
      }
      
}
   else $value = isset($_POST[$column])? mysqli_real_escape_string($conn, $_POST[$column]) : '';
  

   $db_arr[$column] =$value;
}

$table_properties = "`".implode("`, `", array_keys($db_arr))."`";
$table_value = "'".implode("', '", array_values($db_arr))."'";

$_SESSION['showAlert'] = false;
$_SESSION['showError'] = false;

try{
            $result = mysqli_query($conn ,"INSERT INTO $table_name ($table_properties) VALUES ($table_value);");
            $product_id = mysqli_insert_id($conn);
            if($table_name === 'products'){
              
               $suppliers = isset($_POST['suppliers']) ? $_POST['suppliers'] : [];
               if($suppliers){
                  foreach($suppliers as $supplier){
                     $sql ="INSERT INTO `productsuppliers` (`supplier`,`product`,`updated_at`,`created_at`) VALUES ($supplier, $product_id, NOW(), NOW());";
                     $result = mysqli_query($conn ,$sql);
                  }
               }
            }
            $_SESSION['showAlert'] = true;
}
catch(PDOException $e){
    $_SESSION['showError'] = true;
}
 header("location: ../admin/".$_SESSION['redirect_to']);
?>