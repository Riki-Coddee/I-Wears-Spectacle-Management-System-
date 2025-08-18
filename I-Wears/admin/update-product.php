<?php
// include "../php/database.php";
// $pId=$_POST['pid'];
// $productName = $_POST['product_name'];
// $productDescription = $_POST['description'];
// $productCategory = $_POST['category'];

// $target_dir = "uploads/";
// $file_data = $_FILES['img'];
// $file_name_value = NULL;
// if($file_data['tmp_name'] != ''){

// $file_name = $file_data['name'];
// $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
// $file_name ='product-'.time().'.'.$file_ext;
// $check = getimagesize($file_data['tmp_name']);
// if($check){ 
//      if(move_uploaded_file($file_data["tmp_name"], $target_dir.$file_name)){$file_name_value = $file_name;}
    
// }
// }




// try{
//     $sql= "UPDATE `products` SET `product_name`='$productName', `description`='$productDescription',`category`='$productCategory',
//     `img`='$file_name_value', `updated_at`=NOW() WHERE `id`='$pId' ";
//     $result = mysqli_query($conn, $sql);

//    //Delete old values
//    $deleteOldValue = mysqli_query($conn, "DELETE FROM productsuppliers WHERE product=$pId");

//    //Loop through suppliers and add record
//    //Get Suppliers
//    $suppliers = isset($_POST['suppliers']) ? $_POST['suppliers'] : array();
//   if (!empty($suppliers)) {
//     foreach($suppliers as $supplier){
//        $sql ="INSERT INTO `productsuppliers` (`supplier`,`product`,`updated_at`,`created_at`) VALUES ($supplier, $pId, NOW(), NOW());";
//        $result = mysqli_query($conn ,$sql);
//  }
// }


//     echo json_encode([
//         'status' => true,
//         'message' => $productName.' updated successfully to the system.'
//     ]);
// }
// catch(PDOException $e){
//     echo json_encode([
//         'status' => false,
//         'message' => 'Error processing your request'
//     ]);
// }


include "../php/database.php";
$pId = $_POST['pid'];
$productName = mysqli_real_escape_string($conn, $_POST['product_name']);
$productDescription = mysqli_real_escape_string($conn, $_POST['description']);
$productCategory = $_POST['category'];
$price = $_POST['price'];

$target_dir = "uploads/";
$file_name_value = NULL;

// Check if a new file is uploaded
if (!empty($_FILES['img']['tmp_name'])) {
    $file_data = $_FILES['img'];
    $file_name = $file_data['name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = 'product-' . time() . '.' . $file_ext;
    $check = getimagesize($file_data['tmp_name']);
    if ($check) {
        if (move_uploaded_file($file_data["tmp_name"], $target_dir . $file_name)) {
            $file_name_value = $file_name;
        }
    }
}

// Fetching existing img value
$existing_img_query = mysqli_query($conn, "SELECT `img` FROM `products` WHERE `id`='$pId'");
if ($existing_img_row = mysqli_fetch_assoc($existing_img_query)) {
    $existing_img_value = $existing_img_row['img'];
}

// Determine the value to be used in the update
$img_column_value = !empty($file_name_value) ? $file_name_value : $existing_img_value;

try {
    $sql = "UPDATE `products` SET `product_name`='$productName', `description`='$productDescription',`category`='$productCategory',`price`='$price',
    `img`= IF('$file_name_value' != '', '$file_name_value', `img`), `updated_at`=NOW() WHERE `id`='$pId' ";
    $result = mysqli_query($conn, $sql);

    // Delete old values
    $deleteOldValue = mysqli_query($conn, "DELETE FROM productsuppliers WHERE product=$pId");

    // Loop through suppliers and add record
    // Get Suppliers
    $suppliers = isset($_POST['suppliers']) ? $_POST['suppliers'] : array();
    if (!empty($suppliers)) {
        foreach ($suppliers as $supplier) {
            $sql = "INSERT INTO `productsuppliers` (`supplier`,`product`,`updated_at`,`created_at`) VALUES ($supplier, $pId, NOW(), NOW());";
            $result = mysqli_query($conn, $sql);
        }
    }

    echo json_encode([
        'status' => true,
        'message' => $productName . ' updated successfully to the system.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => false,
        'message' => 'Error processing your request'
    ]);
}
?>

