<?php session_start();
$sessionActive = isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] == true;

include "php/database.php";
$showAlert=false;
$showError=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['quantity'])){
                    $qty = (int)$_POST['quantity'];
                    $proId = $_POST['product_id'];
                    $userId = $_POST['user_id'];
                
                    $sql="SELECT * FROM `usercart` WHERE `users`='$userId' AND `product`='$proId'";
                    $query=mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query)>0) {
                                            $sql="UPDATE `usercart` SET `quantity`='$qty'WHERE `users`='$userId' AND `product`='$proId' ";
                                            $result = mysqli_query($conn, $sql);  
                                            if($result){
                                                $showAlert="Your Cart Updated Succesfully.";
                                            }
                                            else{
                                                $showError="Your Cart Cannot be updated.";
                                            }
                            }
                    else{
                                    $sql= "INSERT INTO `usercart` (`users`,`product`,`quantity`,`ordered_at`) VALUES ('$userId','$proId','$qty', NOW())";
                                    $result = mysqli_query($conn, $sql);
                                    if($result){
                                        $sql= "DELETE FROM `wishlist` WHERE `user`='$userId' AND `product`='$proId'";
                                         $result= mysqli_query($conn, $sql);
                                         if($result){
                                        $showAlert="New item has been added to your cart.";
                                         }
                                         else{
                                            $showError="New item cannot be added to your cart.";
                                         }
                                    }
                                    else{
                                        $showError="New item cannot be added to your cart.";
                                    }
                        }
        }
          if(isset($_POST['uId'])){
           $userId = $_POST['uId'];
           $pId = $_POST['pId'];
           //check if product is already added to cart or not
           $query = "SELECT * FROM `usercart` WHERE `users`='$userId' AND `product`='$pId'";
           $result = mysqli_query($conn, $query);
           if(mysqli_num_rows($result) <= 0){
                    //check if product already exists to your wishlist
                    $sql= "SELECT * FROM `wishlist` WHERE `user` = '$userId' AND `product`='$pId'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)<=0){
                        $sql="INSERT INTO `wishlist` (`user`,`product`) VALUES ('$userId','$pId') ";
                        $result = mysqli_query($conn, $sql);  
                        if($result){
                            $showAlert="New Product has been added to the wishlist.";
                        }
                        else{
                            $showError="New Product hasn't been added to the wishlist.";
                        }
                    }
                    else{
                        $showError="Already added to your wishlist.";
                    }
            }
            else {
                $showError="Already added to cart.";
            }
          }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Iwear_css/iwear.css">
    <link rel="stylesheet" href="Iwear_css/footer.css">
    <link rel="stylesheet" href="Iwear_css/product.css">
    <!-- Boostrap Css -->
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css.map">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="icon" href="image/Black White Bold Business Logo.jpg" type="image/iwear-logo">
    
    <title>Products Buy</title>
</head>

<body>
    <style>
        .proHeading {
            font-weight:bold;
            font-size:25px;
        }
        .margin-top{
            margin-top: 50px;
        }
    </style>    
    <?php
    include 'partials/header.php';
    if($showAlert!=false){
    echo '<div class="alert alert-success alert-dismissible fade show my-10 margin-top" role="alert">
          <strong>Success!</strong>'.' '.$showAlert.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if($showError!=false){
    echo '<div class="alert alert-danger alert-dismissible fade show margin-top" role="alert">
          <strong>Error!</strong>'.' '.$showError.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
    ?>
     <?php include 'php/database.php';
     $productId = $_GET['id'];
     if(isset($_SESSION['user'])){
     $user = $_SESSION['user'];
     }
                                        $sql= "SELECT * FROM `products` WHERE `id`='$productId'";
                                        $result=mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                           
                                                                

                                        ?>
    <div class="productDetails">
        <div class="photo">
          <img src="admin/uploads/<?=$row['img']?>" alt="">
        </div>
                            <div class="productInfo">
                                                <div><h1 class="proHeading">Product Name:</h1><p class="proFetch"><?=$row['product_name']?></p></div>
                                                <div><h1 class="proHeading">Description:</h1><p class="proFetch"><?=$row['description']?></p></div>
                                                <div> <h1 class="proHeading">Category:</h1><p class="proFetch"><?=$row['category']?></p></div>
                                                <div><h1 class="proHeading">Price:</h1><p class="proFetch"><?=$row['price']?></p></div>
                            
                            <div>
            <!-- Add to cart form -->
            <form method="post" class="productQuantity" id="myForm">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" min="1" maxlength="<?php 
                $sql = "SELECT `stock` from `products` WHERE `id` = $productId";
                $result = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_assoc($result)){
                    echo $row['stock'];
                }
                ?>" required>
                <input type="hidden" name="product_id" value="<?php echo $productId ?>">
                <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                 
            </form>
            <!-- Wishlist form -->
            <form method="post"  id="myForm2">
                <input type="hidden" name="pId" value="<?php echo $productId ?>">
                <input type="hidden" name="uId" value="<?php echo $user['id'] ?>">
                 
            </form>
        </div>
        
        <div>
                <button class="addCart cartBtn" id="triggerForm">Add to cart</button>
                <button class="wishlist cartBtn" id="wishlistForm">Add to wishlist</button>
            </div>
           
        </div>
    </div>
    
    <?php }?>
    
    <div class="mainThree rectangle-category">

                            <h1 class="seller category-h1">New Features</h1>
                            <div class="flexThree">
                            
                                <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['category'] === 'Other New Feature Spectacles'){
                                                                

                                        ?>
                                <div class="ThirdImg product-col">
                                   <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a> 
                                </div>
                              <?php
                                            }
                              }
                              ?>
                            </div>
                       </div>
                       <?php include 'partials/footer.php'; ?>
                       <!-- bootstrap Javascript  -->
                       <script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
                       <script src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>
                       <script src="javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
                       <script src="javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>

            <script src="javascript/product.js"></script>
            <script>
                
                  if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }


            document.getElementById('triggerForm').addEventListener('click', function() {
                <?php if($sessionActive):?>
                if(document.getElementsByName("quantity")[0].value >0){
                     document.getElementById('myForm').submit();
                }
                else{
                    alert("Please enter the quantity of an item. Quantity can't be 0.")
                }
                <?php else: ?>
                alert("You must be logged in to add products to your cart.");
                window.location.href = "partials/login.php";
                <?php endif; ?>
});
            document.getElementById('wishlistForm').addEventListener('click', function() {
                        <?php if($sessionActive):?>
                    document.getElementById('myForm2').submit();
                        <?php else: ?>
                        alert("You must be logged in to add products to your wishlist.");
                        window.location.href = "partials/login.php";
                        <?php endif; ?>
                
            });

</script>
 
</body>
</html>