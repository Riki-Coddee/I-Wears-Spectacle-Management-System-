
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
$admin = $_SESSION["admin"];
$admin['permission'] = explode (',',$admin['permission']);
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
include "../php/database.php"; 
$showAlert = false;
$showError = false;

    $sql ="SELECT * FROM `products`";
    $result = mysqli_query($conn, $sql);

    
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
    <div id="dltAlert">
        
     </div>
    

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
  <!-- fill in modal dynamically using js for alerting product updation -->
  </div>
</div>



    <div id="dashboardMainContainer">
        <?php include "adminpartials/adminsidebar.php"; ?>
        <div class="dashboard-contents_Container">
            
            <?php include "adminpartials/admintopnov.php"; ?>
            <?php
              if(in_array('product_view',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                        <div class="column column-10">
                             <h1 class="adminInsertHeading"><i class="fa fa-list"></i>List of Products</h1>
                             <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                             <th>Product Name</th>
                                             <th>Stock</th>
                                             <th>Description</th>
                                             <th>Price</th>
                                             <th>Category</th>
                                             <th>Supplier</th>
                                             <th>Created By</th>
                                             <th>Created At</th>
                                             <th>Updated At</th>
                                             <?php
                                        if(in_array('product_edit',$admin['permission']) || in_array('product_delete',$admin['permission'])){
                                                    ?>
                                             <th>Action</th>
                                             <?php } ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr> 
                                            <?php
                                            
                                               while ($row = mysqli_fetch_assoc($result)) { 
                            
                                                   ?>
                                                    <tr> 
                                                <td><?php echo $row['id'] ?></td>
                                             <td class="firstName">
                                             <img class="productImages" src="uploads/<?php echo $row['img'] ?>" alt="">  
                                            </td>
                                             <td class="firstName"><?php echo $row['product_name'] ?></td>
                                             <td class="firstName"><?php echo number_format($row['stock']) ?></td>
                                             <td class="lastName"><?php echo $row['description'] ?></td>
                                             <td class="price"><?php echo $row['price'] ?></td>
                                             <td class="lastName"><?php echo $row['category'] ?></td>
                                             <td class="lastName"><?php 
                                                 $pid = $row['id'];
                                                 $statement = "SELECT supplier_name FROM suppliers, productsuppliers WHERE productsuppliers.product=$pid AND productsuppliers.supplier = suppliers.id";
                                                 $query= mysqli_query($conn, $statement);
                                                 while ($data = mysqli_fetch_assoc($query)) {
                                                    foreach ($data as $value) {
                                                        echo $value . "<br>"; 
                                                    }
                                                 }
                                              
                                                ?></td>
                                             <td class="email"><?php 
                                             
                                             $uid = $row['created_by'];
                                      $query= mysqli_query($conn, "SELECT * FROM `admin` WHERE `id`='$uid'");
                                      while ($data = mysqli_fetch_assoc($query)) {
                                        echo $data['first_name']." ".$data['last_name'];
                                      }
                                   
                                      
                                               ?></td>
                                             <td><?php echo date('F d,Y @ H:i:s A', strtotime($row['created_at'])) ?></td>
                                             <td><?php echo date('F d,Y @ H:i:s A', strtotime($row['updated_at'])) ?></td>  
                                             <td>
                                                <?php if(in_array('product_edit',$admin['permission']) ){
                                                    ?>
                                                <div><a href=""  class="updateProduct" data-productid="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#exampleModal" id="updateProduct"><i class="fa fa-pencil"></i>Edit</a>
                                               </div>
                                               <?php
                                                }
                                               ?>
                                               <?php if(in_array('product_delete',$admin['permission']) ){
                                                    ?>
                                               <div> 
                                               <a href="" class="deleteProduct" data-pid="<?= $row['id']?>" data-pname="<?=$row['product_name']?>" ><i class="fa fa-trash"></i>Delete</a>
                                               <div>
                                                <?php
                                               }
                                                ?>
                                             </td>
                                             </tr> 
                                             <?php } ?>
                            
                                              
                                            
                                        </tbody>
                                     </table>
                                </div>
                             </div>
                             <p class="countUsers"><?php  echo mysqli_num_rows($result).' PRODUCTS'; ?></p>
                        </div>
                    </div>
                    
                    <?php
    if(isset($showAlert) && $showAlert == true){
    echo'
    <div class="addAdminSuccess">
        <p>'.$firstname.' has been successfully added.</p>
    </div>
    ';
    }
    if($showError){
        echo'
        <div class="addAdminError">
            <p>'.$showError.' </p>
        </div>
        ';
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
    




<?php
include "../php/database.php";
$sql= "SELECT * FROM `suppliers`";
$result = mysqli_query($conn, $sql);
  $supplier_arr=[];

  while ($supplier= mysqli_fetch_assoc($result)) {
    $supplier_arr[$supplier['id']]= $supplier['supplier_name'];
  }

$supplier_arr= json_encode($supplier_arr);
?>    
<script>
const suppliersList = <?= $supplier_arr?>;



function script() {
      this.initialize = function(){
        this.registerEvents();
                                },
         this.registerEvents = function(){
                document.addEventListener('click', function(e){
                       targetElement = e.target;
                       classList = targetElement.classList;
                       modalDialog =  document.getElementById("modal-dialog");
                       dltAlert =  document.getElementById("dltAlert");
            
          
          
                              if(classList.contains('deleteProduct')){
             e.preventDefault();
             productId = targetElement.dataset.pid;
             productName = targetElement.dataset.pname;
             if (window.confirm('Are you sure to delete'+productName+'?')) {
                $.ajax({
                    method: 'POST',
                    data: {
                      id: productId,
                      table : 'products'
                    },
                    url: 'delete.php',
                    dataType: 'json',
                    success: function(data) {
                        status =  data.status? "Success" : "Error";;
                        statusAlert = data.status?"success" : "danger";
                        message = data.status? productName+" "+"has been successfully deleted" : "Error processing your request" ;
                            dltAlert.innerHTML = `
                            <div class="alert alert-`+statusAlert+` alert-dismissible fade show" role="alert">
                           <strong>`+status+`!</strong>`+message +`.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="reload()" aria-label="Close"></button>
                           </div>`;
                                              

                                            }
 
                })
             }
            }

                            if(classList.contains('updateProduct')){
                e.preventDefault();
                 pid = targetElement.dataset.productid;
                 showEditDialog(pid);   }     
           
        
        
                      })
             }
}
var script = new script;
script.initialize();
  

const onUpdateClick = ()=>{
    var categoryInput = document.getElementById('category').value;
    if (!categoryInput) {
        alert('Please select a category.');
        return false;
    }
    

        var form = $("#updateForm")[0];
        var formData = new FormData(form);
        

        $.ajax({
            url: 'update-product.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType : 'json',
            success: function(response) {
                
               if(response.status){
                 if(confirm(response.message+'\n Press ok to reload the system.')){
                       location.reload();
                 }
               }
            },
            error: function (response) {
                if(!response.status){
                    alert(response.message);
                }
            }
           
        });
    

    }


    function reload() {
        location.reload();
    }

    function showEditDialog(id){
        $.get("../php/get-product.php",{id: id}, function(productDetails) {
            let curSelectedSuppliers = productDetails['suppliers'];
            let supplierOption = '';

            for(const[supId, supName] of Object.entries(suppliersList)) {
                  selected = curSelectedSuppliers.indexOf(supId) > -1 ? "selected" : ''; 
                supplierOption += "<option "+selected+" value="+supId+">"+supName+"</option>";
               }
               


                 categoryArr = ['Rectangle-Shaped Spectacles', 'Round-Shaped Spectacles', 'Square-Shaped Spectacles', 'Asymmetric Spectacles', 'Aviator Spectacles', 'Cat-eye Spectacles','Customized Spectacles','Other New Feature Spectacles'];
                 var selectedOption = '';
                 for (var i = 0; i < categoryArr.length; i++) {
     category = categoryArr[i];
     selected = category === productDetails['category'] ? 'selected' : '';
     selectedOption += `<option value="${category}" ${selected}>${category}</option>`;
                 }
                  
                 var categoryOption = selectedOption;
               
            modalDialog.innerHTML = `
    <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update <strong>`+productDetails.product_name+`<strong></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="dashboard-update_model">
                <form method="post"  enctype="multipart/form-data" id="updateForm">
                    <div class="adFormInputConatiner">
           <label for="product_name">Product Name</label>
           <input type="text" id="product_name" name="product_name" value="`+productDetails.product_name+`" >
         </div>
         <div class="adFormInputConatiner">
                                             <label for="suppliers">Suppliers</label>
                                            <select name="suppliers[]" id="supplier" multiple>
                                                <option value="">Select Supplier</option>
                                                `+supplierOption+`
                                            </select>
                                            
                                         </div>
         <div class="adFormInputConatiner">
         <label for="category">Category</label>
                                            <select name="category" id="category" style="width:100%" required>
                                                <option value="">Select Category</option>
                                                `+categoryOption+`
                                              
                                            </select>
         <div class="adFormInputConatiner">
            <label for="description">Description</label>
             <textarea type="text" class="productDesTextArea" id="productDescription" name="description" >`+productDetails.description+`</textarea>
         </div>
         <input type="hidden" value="`+productDetails.id+`" name="pid">
         <div class="adFormInputConatiner">
            <label for="img">Product Image</label>
             <input type="file" class="productDesTextArea" id="img" name="img" ></input>
         </div>
         <div class="adFormInputConatiner">
           <label for="price">Price</label>
           <input type="text" id="price" name="price" value="`+productDetails.price+`" >
         </div>
              </form>
              </div>
              
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="onUpdateClick()">Save changes</button>
          
        </div>
      </div>
    </div>`;
        }, 'json');
    }
</script>
</html>


  