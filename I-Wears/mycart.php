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
            $updatedAlert = " Your order has been successfully processed using ".$paymentMethod.". Thank you for your purchase";
        } else {
            $updatedError = "Your payment method can't be processed for your order.";
        }
    }
}
// if(isset($_POST['userId'])){
//     $userID = $_POST['userId'];
//     $sql = "UPDATE `usercart` SET `payment method` = NULL WHERE `users` = '$userID'";
//     $query = mysqli_query($conn, $sql); 
//     if($query){
//         $updatedAlert = " Your Order has been cancelled.";
//     }
//     else{
//         $updatedError = "Your order can't be cancelled at the moment. Plese Try again Later.";
//     }
    
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-WEARs - My Cart</title>
   <!-- Boostrap css  -->
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css.map">
    <!-- CSS -->
    <link rel="stylesheet" href="adminstylesheet.css">
    <link rel="stylesheet" href="Iwear_css/iwear.css">
    <link rel="stylesheet" href="Iwear_css/footer.css">
    <link rel="stylesheet" href="Iwear_css/mycart.css">
   
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
          <strong>Success!</strong>'.' '.$updatedAlert.'
          <button type="button" id="alertMessage" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
    <div class="myCart-contents-contents_main" id="myCartContentsMain">
        <div class="row" >
            <h1 class="adminInsertHeading"><i class="fa fa-list"></i> My Cart</h1>
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
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "php/database.php";
                                    $total = 0;
                                    $user = $_SESSION['user'];
                                    $index = 1;
                                    $sql = "SELECT products.product_name,products.category,products.id as pId, products.img, products.price, usercart.quantity 
                                            FROM usercart 
                                            JOIN products ON products.id = usercart.product 
                                            WHERE usercart.users = " . $user['id'];
                                    $query = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                            <tr>
                                                <td><?php echo $index ?></td>
                                                <td class="proImg"><img src="admin/uploads/<?php echo $row['img']; ?>" alt=""></td>
                                                <td class="proNAME"><?php echo $row['product_name']; ?></td>
                                                <td class="proCategory"><?php echo $row['category']; ?></td>
                                                <td class="proPrice"><?php echo 'Rs.'.' '.$row['price']; ?></td>
                                                <td class="orderedQty">
                                                    <form method="post" class="cartForm">
                                                        <input type="number" value="<?php echo $row['quantity']; ?>" min="1" name="quantity" id="myCartQty">
                                                        <input type="hidden" value="<?php echo $row['pId']; ?>" name="proId">
                                                        <input type="hidden" value="<?php echo $user['id']; ?>" name="userId">
                                                        <input type="hidden" value="<?php echo $row['product_name']; ?>" name="proName">
                                                        <button id="myCartBtn">Update</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div> 
                                                        <a href="" class="deleteMyCart" data-pid="<?php echo $row['pId']; ?>" data-p-name="<?php echo $row['product_name']; ?>" data-user-id="<?php echo $user['id']; ?>"><i class="fa fa-trash"></i>Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                <?php  
                                        $total += (int)$row['price'] * $row['quantity']; 
                                        $index++; 
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column col-2">
                <div><h3>Total:</h3></div>
                <div id="totalPrice"><h5><?php echo 'Rs.'.' '.$total; ?></h5></div>
                
                        <div class="myTotal">
                            <form id="purchaseForm" onsubmit="sendEmail(); reset(); return false;">
                                <input type="hidden" value="<?php echo $user['first_name']." ".$user['last_name']; ?>" id="userFullName">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Cash on Delivery">
                                    <label class="form-check-label" for="flexRadioDefault1">Cash on Delivery</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Online Payment" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">Online Payment</label>
                                </div>
                                <input type="hidden" id="userID" value="<?php echo $user['id'] ?>" name="uId">
                                <input type="hidden" id="userEMAIL" value="<?php echo $user['email'] ?>" name="uEmails">
                                <button class="mypurchaseBtn" id="myPurchaseBtn">Make Purchase</button>
                            </form>
                            </div>
                            <div class="paymentMethod">
                                <p class="paymentMethodText">OR</p>
                                <h3 class="paymentMethodHeading">Pay Via:</h3>
                                <img src="image/esewa.png" alt="">
                                <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
 <input type="text" id="amount" name="amount" value="100" required>
 <input type="text" id="tax_amount" name="tax_amount" value ="0" required>
 <input type="text" id="total_amount" name="total_amount" value="100" required>
 <input type="text" id="transaction_uuid" name="transaction_uuid" value="<?php
 $transaction_uuid = str_replace('-', 'h', uniqid('', true));

echo $transaction_uuid;
 ?>"required>
 <input type="text" id="product_code" name="product_code" value ="EPAYTEST" required>
 <input type="text" id="product_service_charge" name="product_service_charge" value="0" required>
 <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
 <input type="text" id="success_url" name="success_url" value="https://esewa.com.np" required>
 <input type="text" id="failure_url" name="failure_url" value="https://google.com" required>
  <input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
 <input type="text" id="signature" name="signature" value="<?php
 
$product_code = "EPAYTEST";

// Concatenate input values into a single string
$input_string = $total . $transaction_uuid . $product_code;

// Define your secret key
$secret_key = '8gBm/:&EnhH.1/q';

// Generate HMAC hash using SHA-256
$hash = hash_hmac('sha256', $input_string, $secret_key, true);

// Encode the hash using Base64
$encoded_hash = base64_encode($hash);

echo $encoded_hash;

 ?>" required>
 <input value="Submit" type="submit">
 </form>
                            </div>
                <?php
                        
                }else{
                               
                                echo " </tbody>
                                </table>
                                </div>
                                <div class='emptyCart'>Your cart is empty. Please add items to your cart before proceeding with checkout.</div>";
                            }
                            ?>
                            
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/enc-base64.min.js"></script>

 
<script src="admin/js/script.js"></script>
<script src="admin/js/jquery/jquery-script.js"></script>
<!-- Bootstrap Javascript  -->
<script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>

<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

// Check if the button exists
var cartBtn = document.getElementById('myCartBtn');

// If the button exists, add event listener
if(cartBtn) {
    cartBtn.addEventListener('click', function() {
        if(document.querySelector('input[name="quantity"]').value > 0) {
            document.getElementById('myForm').submit();
        } else {
            alert("Please specify the quantity of the item. Quantity cannot be less than or equal to 0.");
        }
    });
}
var element = document.getElementById('myCartContentsMain');

// Check if the element has the class
if (element.querySelector('.emptyCart')) {
    element.querySelector(".column.col-1").style.flexBasis = "100%";
} 
var orderMessage = sessionStorage.getItem('orderMessage');
if (orderMessage) {
    // Parse the delete message
    orderMessage = JSON.parse(orderMessage);
    // Display the message
    var orderAlert = document.getElementById('myCartdltAlert');
    orderAlert.innerHTML = `
        <div class="alert alert-${orderMessage.statusAlert} alert-dismissible fade show" role="alert">
            <strong>${orderMessage.status}!</strong> ${orderMessage.message}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;

    // Clear the delete message from session storage
    sessionStorage.removeItem('orderMessage');
}
 
    

if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }



function script() {
      this.initialize = function(){
        this.registerEvents();
                                },
         this.registerEvents = function(){
                document.addEventListener('click', function(e){
                       targetElement = e.target;
                       classList = targetElement.classList;
                       modalDialog =  document.getElementById("modal-dialog");
                       dltAlert =  document.getElementById("myCartdltAlert");
                        if(classList.contains('deleteMyCart')){
                                    e.preventDefault();
                                    productId = targetElement.dataset.pid;
                                    userId = targetElement.dataset.userId;
                                    productName = targetElement.dataset.pName;
                                    //  alertMessage.click();
                                    if (window.confirm('Are you sure to delete ' + productName + '?')) {
                                                $.ajax({
                                                    method: 'POST',
                                                    data: {
                                                        pid: productId,
                                                        uid: userId,
                                                    },
                                                    url: 'delete/deletemycart.php',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        if (data.status) {
                                                            // Deletion successful, show success message after page reloads
                                                                sessionStorage.setItem('deleteMessage', JSON.stringify({
                                                                status: "Success",
                                                                statusAlert: "success",
                                                                message: productName + " has been successfully deleted from your cart"
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
    
           
        
        
                      })
             }
}


var script = new script;
script.initialize();
  

 function reload() {
        location.reload();
    }



var deleteMessage = sessionStorage.getItem('deleteMessage');
if (deleteMessage) {
    // Parse the delete message
    deleteMessage = JSON.parse(deleteMessage);
    // Display the message
    var dltAlert = document.getElementById('myCartdltAlert');
    dltAlert.innerHTML = `
        <div class="alert alert-${deleteMessage.statusAlert} alert-dismissible fade show" role="alert">
            <strong>${deleteMessage.status}!</strong> ${deleteMessage.message}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;

    // Clear the delete message from session storage
    sessionStorage.removeItem('deleteMessage');
}


function sendEmail() {
    const selectedPaymentMethod = document.querySelector('input[name="flexRadioDefault"]:checked').value;
    const totalPrice = document.getElementById("totalPrice").querySelector("h5").innerHTML;
    var randomNumber = Math.floor(Math.random() * (50000000 - 10000000 + 1)) + 10000000;
    var userFullName = document.getElementById('userFullName').value;
    var userEMAIL = document.getElementById('userEMAIL').value;
function generateTableRows() {
    var proName = document.getElementsByClassName('proNAME');
    var proPrice = document.getElementsByClassName('proPrice');
    var proQty = document.getElementsByName('quantity');
    var rows = '';
    for (var i = 0; i <proName.length; i++) {
        // Get the text content of the element
        var productName = proName[i].textContent;
        var productPrice = proPrice[i].textContent;
        var productQty = proQty[i].value;
        
        rows += `
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">${productName}</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">${productPrice}</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">${productQty}</td>
            </tr>
        `; // Output the text content
     } 
    return rows;
}
var tableRows = generateTableRows();
let orderTable = `<table style="border-collapse: collapse; width: 100%;">
                                <tr>
                                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Product</th>
                                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Price</th>
                                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Quantity</th>
                                </tr>
                                ${tableRows}
                          </table>`;



let text = `Dear <b>${userFullName}</b>,<br>
            <br>
            Thank you for shopping with us! We're thrilled to confirm that your order has been successfully processed and is now on its way to you. Below are the details of your purchase:<br>
            <br>
            Order Number: <b>${randomNumber}</b><br>
            Date of Purchase: <b>${new Date()}</b><br>
            Payment Method: <b>${selectedPaymentMethod}</b><br>
            <br>
            Here is a summary of your order:<br>
            <br>
            ${orderTable}
            [Total Price]: <b style="color: green;">${totalPrice}</b><br> 
            <br>
            Your satisfaction is our top priority, and we are committed to ensuring a smooth and enjoyable shopping experience for you. If you have any questions or concerns regarding your order, feel free to contact our customer support team at iwears123@gmail.com or call us at +977-9808000082.<br>
            <br>
            Thank you once again for choosing I-Wears. We look forward to serving you again in the future!<br>
            <br>
            <img src="image/custom.jpg" >
            Best regards,<br>
            <b>Rikesh Shrestha</b><br>
            <b>CEO</b><br>
            <b>I-Wears</b><br>
            <b>+977-99901928282</b><br>
             `;
    Email.send({
    Host : "smtp.elasticemail.com",
    Username : "rikeshshresthaggmu@gmail.com",
    Password : "062A34913A8BEEEECA79134CA4FD6C22435F",
    To : userEMAIL,
    From : "rikeshshresthaggmu@gmail.com",
    Subject : `Thank You for Your Order: ${new Date().toISOString().slice(0,10)}`,
    Body :text
}).then(
    message => {
        if(message == 'OK'){
            
            $.ajax({
                                                    method: 'POST',
                                                    data: {
                                                        userID: document.getElementById("userID").value,
                                                        table: 'usercart'
                                                    },
                                                    url: 'delete/deletemycart.php',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        if (data.status) {
                                                            // Deletion successful, show success message after page reloads
                                                                sessionStorage.setItem('orderMessage', JSON.stringify({
                                                                status: "Success",
                                                                statusAlert: "success",
                                                                message: "Your order has been processed. Kindly check your <i class='fa-solid fa-envelope'></i> <b style='color: red;'>Email</b> for further details."
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
);
}

</script>
