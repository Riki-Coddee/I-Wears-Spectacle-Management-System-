
<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
$admin = $_SESSION['admin'];
$admin['permission'] = explode (',',$admin['permission']);
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
include "../php/database.php"; 
$sql ="SELECT * FROM `products`";
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
     }
     $rows = json_encode($rows);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-WEARs - Admin Panel</title>
   <!-- Boostrap css  -->
    <link rel="stylesheet" href="../Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="../Iwear_css/bootstrap.min.css.map"> 
    <!-- CSS LINK -->
    <link rel="stylesheet" href="adminstylesheet.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">






</head>
<body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
  
  </div>
</div>



    <div id="dashboardMainContainer">
        <?php include "adminpartials/adminsidebar.php"; ?>
        <div class="dashboard-contents_Container">
            
            <?php include "adminpartials/admintopnov.php"; ?>
            <?php
              if(in_array('po_create',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                       <div class="column column20">
                         <h1 class="adminInsertHeading"><i class="fa fa-plus"></i>Order Product</h1>
                                <div>
                                          <div class="align-text">
                                               <button class="orderBtns orderProductBtn" id="orderProductBtn">Order Product</button>
                                          </div>
                                  <form action="../php/save-order.php" method="post">

                                    <div id="orderProductLists">
                                        
                                             
                                        
                                    </div>
                                    <div class="align-text">
                                      <button class="orderBtns submitProductBtn">Submit Order</button>
                                    </div>
                                  </form>
                                      
                                 </div>
                        
                        </div>
                    </div>
                    
                    <?php
    if(isset($_SESSION['showAlert']) && $_SESSION['showAlert'] == true){
    echo'
    <div class="addAdminSuccess">
        <p>Order Succesfully Created.</p>
    </div>
    ';
    $_SESSION['showAlert'] = false;

    }
    if(isset($_SESSION['showError']) && $_SESSION['showError'] == true){
        echo'
        <div class="addAdminError">
            <p>Your order cannot be added at the moment. Please try again with suitable imformation. </p>
        </div>
        ';
$_SESSION['showError'] = false;
    }
    ?>
               
</div>
</div>
<?php
              } else{
         ?>
           <div class="accessdenied">
            <img src="../image/access_denied.png" alt="">
                  <p>Access Denied: Unauthorized Entry.</p> 
                </div>
        <?php  } ?>
</div>
</div>
</body>
<script src="js/script.js"></script>
<script src="js/jquery/jquery-script.js"></script>

    <!-- Bootstrap Javascript  -->
    <script src="../javascript/bootstrap-Js/bootstrap.min.js"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.min.js.map"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
    <script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>
    



    
<script>
    if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }

    const products = <?= $rows; ?>;
 
 
    
    function script() {
        let vm = this;
        let count = 0;
        this.initialize = function () {
            this.registerEvents();
            addProductRow();
        },
             this.registerEvents = function () {
                            
                                    document.addEventListener("click", (e) => {
                                                            let targetElement = e.target;
                                                            classList = targetElement.classList;
                                                            if (targetElement.id === 'orderProductBtn') {
                                                                addProductRow(); // Add new product row
                                                            }
                                                            if(classList.contains('removeOrderBtn')){
                                                                let orderRow = targetElement.closest(".orderProductRow");
                                                                orderRow.remove();
                                                                
                                                            }
                                   });

              
              
              
                                         document.addEventListener("change",(e)=>{
                
                                                    let targetElement = e.target;
                                                    classList = targetElement.classList;
                                                //Add supplier row when product option change
                                                if (classList.contains("productNameSelect")) {
                                                
                                                    let pId = targetElement.value;
                                                    counterId =  targetElement.closest(".orderProductRow").querySelector(".supplierRows").dataset.counter;
                                                    
                                                  vm.renderSupplierRows(pId, counterId);  
                                                    }
            
                                        })
        },
        this.renderSupplierRows = function(pId, counterId) {
                            let supplierRows = ''; // Declare outside to ensure accessibility

                        fetch("../php/get-product-supplier.php?id=" + pId)
                            .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                                return response.json();
                            })
                            .then(supplierDetails => {
                            let supplierRows = '';
                            supplierDetails.forEach(supplier => {
                                supplierRows += `
                                    <div class="row">
                                        <div style="width: 50%;">
                                            <p class="supplierName">${supplier['supplier_name']}</p>
                                        </div>
                                        <div style="width: 50%;">
                                            <label for="quantity">Quantity</label>
                                            <input type="number"  name="quantity[`+counterId+`][`+supplier['id']+`][]" class="quantityStyle" placeholder="Enter quantity...." />
                                        </div>
                                    </div>`;
                                    let supplierRowContainer = document.getElementById("supplierRow_" + counterId);
                            supplierRowContainer.innerHTML = supplierRows;
                            });
                        
                        })
        }

        function renderProductOption() {
            let optionHTML = "";
                            products.forEach(product => {
                                optionHTML += '<option value="' + product['id'] + '">' + product['product_name'] + '</option>';
                            });
                            return optionHTML;
                        }

                        self.addProductRow= ()=>{
                            let orderProductLists = document.getElementById("orderProductLists");
                            let productOptions = `
                                <div>
                                    <label for="product_name">Product Name</label>
                                    <select name="product_name[]" id="product_name" class="productNameSelect"> 
                                        <option value="">Select Product</option>
                                        ${renderProductOption()}
                                    </select>
                                    <button class="appBtn removeOrderBtn">Remove</button>
                                </div>`;
                            let newProductRow = document.createElement("div");
                            newProductRow.classList.add("orderProductRow");
                            newProductRow.innerHTML = `
                                ${productOptions}
                                <div class="supplierRows" id="supplierRow_`+count+`" data-counter="`+count+`">
                                </div>`;
                                count++;
                            orderProductLists.appendChild(newProductRow);
        }

       

       
    }



 


(new script()).initialize();

</script>
</html>