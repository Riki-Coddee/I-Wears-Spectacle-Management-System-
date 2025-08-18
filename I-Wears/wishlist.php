<?php 
session_start();

if(!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin']!=true){
header("Location:partials/login.php");
exit;
}
include "php/database.php";
$updatedAlert = false;
$updatedError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['quantity'])) {
        $qty = $_POST['quantity'];
        $proId = $_POST['proId'];
        $userId = $_POST['userId'];
        $productName = $_POST['proName'];
        $query = 
        $sql = "UPDATE `usercart` SET `quantity`='$qty' WHERE `users`='$userId' AND `product`='$proId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $updatedAlert = $productName . "'s quantity successfully updated in your cart.";
        } else {
            $updatedError = $productName . "'s quantity cannot be successfully updated.";
        }
    }
    if (isset($_POST['flexRadioDefault'])) {
        $userId = $_POST['uId'];
        $paymentMethod = $_POST['flexRadioDefault'];
        // Remove the space in the column name or use backticks
        $sql = "UPDATE `usercart` SET `payment method`='$paymentMethod' WHERE `users`='$userId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $updatedAlert = "Payment Method: ".$paymentMethod." "."is successfully updated";
        } else {
            $updatedError = "Payment method cannot be successfully updated.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Wears - Wishlist</title>
    <!-- Boostrap css  -->
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css"> 
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css.map">
    <!-- CSS -->
    <link rel="stylesheet" href="Iwear_css/iwear.css">
    <link rel="stylesheet" href="Iwear_css/footer.css">
    <link rel="stylesheet" href="Iwear_css/wishlist.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    
    <link rel="icon" href="image/Black White Bold Business Logo.jpg" type="image/iwear-logo">





</head>
<body>








   
        <?php include "partials/header.php"; ?>
      <!-- Delete Warning-->
<div id="myCartdltAlert">
<!-- will be updated dynamycally after deletion -->        
</div>
<?php
if($updatedAlert!=false){
    echo '<div class="alert alert-success alert-dismissible fade show my-10 margin-top" role="alert">
          <strong>Success!.</strong>'.' '.$updatedAlert.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if($updatedError!=false){
    echo '<div class="alert alert-danger alert-dismissible fade show margin-top" role="alert">
          <strong>Error!</strong>'.' '.$updatedError.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
 ?>           
           
            <div class="myCart-contents">
                <div class="myCart-contents-contents_main">
                    <div class="row">
                        <h1 class="adminInsertHeading"><i class="fa fa-list"></i>My WishList</h1>
                        <div class="column col-1">
                             <div class="section_content">
                                <div class="users">
                                    <table>
                                                            <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Product Image</th>
                                                                                <th>Product Name</th>
                                                                                <th>Category</th>
                                                                                <th>Price</th>
                                                                                <th>Action</th>
                                                                                
                                                                            </tr>
                                                            </thead>
                                        <tbody>
                                                    <tr>
                                                                        <?php
                                                                                        include "php/database.php";
                                                                                        $total = 0;
                                                                                        $user = $_SESSION['user'];
                                                                                        $index = 1;
                                                                                        $sql = "SELECT products.product_name,products.category,products.id as pId, products.img, products.price
                                                                                                FROM wishlist 
                                                                                                JOIN products ON products.id = wishlist.product 
                                                                                                WHERE wishlist.user = " . $user['id'];
                                                                                                
                                                                                        $query = mysqli_query($conn, $sql); 
                                                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                                                        
                                                                        ?>
                                                   
                                                                <td><?php echo $index ?></td>
                                                                <td class="proImg"><img src="admin/uploads/<?php echo $row['img']; ?>" alt=""></td>
                                                                <td class="proNAME"><?php echo $row['product_name']; ?></td>
                                                                <td class="proNAME"><?php echo $row['category']; ?></td>
                                                                <td class="proPrice"><?php echo 'Rs.'.' '.$row['price']; ?></td>
                                                                
                                                    
                                                    
                                                    <td>
                                                                        <div> 
                                                                            <a href="productbuy.php?id=<?php echo $row['pId']?>" class="buynowMyCart" id="buyMyCartBtn"><i class="fa fa-cart-plus"></i>Add to Cart</a>
                                                                        </div>
                                                                        <div> 
                                                                                <a href="" class="deleteMyCart" data-u-id="<?php echo $user['id']?>" data-p-id="<?php echo $row['pId']?>" data-p-name="<?php echo $row['product_name']?>"><i class="fa fa-trash"></i>Delete</a>
                                                                        </div>
                                                        
                                                    
                                                                </td>
                                                     </tr> 
                                            
                                            
                                              <?php $index++; }?>
                                            
                                        </tbody>
                                     </table>
                                </div>
                             </div>
                            
                        </div>
                        
                        
                           
                          
                    </div>
                    
               
</div>
</div>
                           <?php
                           if(mysqli_num_rows($query)==0){
                                echo "<div class='emptyCart'>Your wishlist is empty. Please add items to your wishlist before proceeding with checkout.</div>";
                            }
                            ?>
</div>
</div>
</body>

<script src="admin/js/jquery/jquery-script.js"></script>

<!-- Bootstrap Javascript  -->
<script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>

<script>
var wishlistMessage = sessionStorage.getItem('wishlistMessage');
if (wishlistMessage) {
    // Parse the delete message
    wishlistMessage = JSON.parse(wishlistMessage);
    // Display the message
    var dltAlert = document.getElementById('myCartdltAlert');
    dltAlert.innerHTML = `
        <div class="alert alert-${wishlistMessage.statusAlert} alert-dismissible fade show" role="alert">
            <strong>${wishlistMessage.status}!</strong> ${wishlistMessage.message}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="reload()" aria-label="Close"></button>
        </div>`;
    // Clear the delete message from session storage
    sessionStorage.removeItem('wishlistMessage');
}

 
if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }



    function script() {
    this.initialize = function(){
        this.registerEvents();
    };

    this.registerEvents = function(){
        document.addEventListener('click', function(e){
            var targetElement = e.target;
            var classList = targetElement.classList;
            var modalDialog = document.getElementById("modal-dialog");
            var dltAlert = document.getElementById("myCartdltAlert");

            if(classList.contains('deleteMyCart')){
                e.preventDefault();
                var productId = targetElement.dataset.pId;
                var uId = targetElement.dataset.uId;
                var productName = targetElement.dataset.pName;
                if (window.confirm('Are you sure to delete ' + productName + ' from your wishlist?')) {
                    $.ajax({
                        method: 'POST',
                        data: {
                            pid: productId,
                            uid: uId,
                            productName : productName 
                        },
                        url: 'delete/delete-wishlist.php',
                        dataType: 'json',
                        success: function(data) {
                            if (data.status) {
                                sessionStorage.setItem('wishlistMessage', JSON.stringify({
                                                                status: data.status? "Success" : '',
                                                                statusAlert: data.status? "success": '',
                                                                message: data.message
                                }));
                                location.reload();
                            } else {
                                // Deletion failed, show error message
                                alert("Error processing your request");
                            }
                        }
                    });
                }
            }
        });
    };
}

var scriptObj = new script();
scriptObj.initialize();

function reload() {
    location.reload();
}


    
</script>
