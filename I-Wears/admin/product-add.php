
<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
$admin = $_SESSION['admin'];
$admin['permission'] = explode (',',$admin['permission']);
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");

$_SESSION['table'] = 'products';
$_SESSION['redirect_to'] = 'product-add.php';

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
              if(in_array('product_create',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                    <div class="column column20">
                    <h1 class="adminInsertHeading"><i class="fa fa-plus"></i>Add Product</h1>
                              <div id="adminAddFormConatiner">

                                    <form method="post" action="../php/add.php" enctype="multipart/form-data">
                                        <div class="adFormInputConatiner">
                                           <label for="product_name">Product Name</label>
                                           <input type="text" id="product_name" name="product_name" placeholder="Enter product name...." required>
                                         </div>
                                         <div class="adFormInputConatiner">
                                            <label for="description">Description</label>
                                             <textarea type="text" class="productDesTextArea" id="description" name="description" placeholder="Enter product description..." required></textarea>
                                         </div>
                                         <div class="adFormInputConatiner">
                                             <label for="suppliers">Suppliers</label>
                                            <select name="suppliers" id="supplier" multiple>
                                                <option value="">Select Supplier</option>
                                                <?php
                                                 include "../php/database.php";
                                                 $sql= "SELECT * FROM `suppliers`";
                                                 $result = mysqli_query($conn, $sql);
                                                 while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value=".$row['id'].">".$row['supplier_name']."</option>";
                                                 }
                                                ?>
                                                
                                            </select>
                                            
                                         </div>
                                         <div class="adFormInputConatiner">
                                             <label for="category">Category</label>
                                            <select name="category" id="category" required>
                                                <option value="">Select Category</option>
                                                <option value="Rectangle-Shaped Spectacles">Rectangle-Shaped Spectacles</option>
                                                <option value="Round-Shaped Spectacles">Round-Shaped Spectacles</option>
                                                <option value="Square-Shaped Spectacles">Square-Shaped Spectacles</option>
                                                <option value="Asymmetric Spectacles">Asymmetric Spectacles</option>
                                                <option value="Aviator Spectacles">Aviator Spectacles</option>
                                                <option value="Cat-eye Spectacles">Cat-eye Glasses</option>
                                                <option value="Customized Spectacles">Customized Spectacles</option>
                                                <option value="Other New Feature Spectacles">Other New Feature Spectacles</option>
                                              
                                            </select>
                                            
                                         </div>
                                         <div class="adFormInputConatiner">
                                            <label for="img">Product Image</label>
                                             <input type="file" class="productDesTextArea" id="img" name="img" required ></input>
                                         </div>
                                         <div class="adFormInputConatiner">
                                            <label for="price">Price</label>
                                             <input type="price" class="productDesTextArea" id="price" name="price" required ></input>
                                         </div>
                                         <button type="submit" id="adFormBtn"><i class="fa fa-plus"></i>Add Product</button>
                                    </form>
                              </div>
                        
                     </div>
                        
                    
                    <?php
    if(isset($_SESSION['showAlert']) && $_SESSION['showAlert'] == true){
    echo'
    <div class="addAdminSuccess">
        <p>Product has been successfully added.</p>
    </div>
    ';
    $_SESSION['showAlert'] = false;

    }
    if(isset($_SESSION['showError']) && $_SESSION['showError'] == true){
        echo'
        <div class="addAdminError">
            <p>Product cannot be added at the moment. Please try again with suitable imformation. </p>
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
    
    
    
    
function script() {
    this.initialize = function(){
        this.registerEvents();
    },
    this.registerEvents = function(){
        document.addEventListener('click', function(e){
            targetElement = e.target;
            classList = targetElement.classList;
            modalDialog =  document.getElementById("modal-dialog");
          
          
            if(classList.contains('deleteUser')){
             e.preventDefault();
             userId = targetElement.dataset.userid;
             fname = targetElement.dataset.fname;
             lname = targetElement.dataset.lname;
             fullname = fname+' '+lname;
             if (window.confirm('Are you sure to delete'+fullname+'?')) {
                $.ajax({
                    method: 'POST',
                    data: {
                        user_id: userId,
                        f_name: fname,
                        l_name: lname
                    },
                    url: 'delete-user.php',
                    dataType : 'json',
                    success: function(data) {
                        if(data.status){
                            if(confirm(data.message)){
                                location.reload();
                            }
                        }
                        
                    }
 
                })
             }
            }

             if(classList.contains('updateUser')){
                e.preventDefault();

                firstName = targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                lastName = targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                email = targetElement.closest('tr').querySelector('td.email').innerHTML;

                modalDialog.innerHTML = `
    <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update `+firstName+` `+lastName+`</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="dashboard-update_model">
           <form action="post">
            <div class="adFormInputConatiner">
                 <label for="firstnameUpdate" >First Name</label>
                 <input type="text" id="firstnameUpdate"  value="`+firstName+`" name="firstnameee">
            </div>
                 <div class="adFormInputConatiner">
                 <label for="lastnameUpdate">Last Name</label>
                 <input type="text" id="lastnameUpdate"value="`+lastName+`">
                 </div>
                 <div class="adFormInputConatiner">
                 <label for="emailUpdate">Email Address</label>
                 <input type="email" id="emailUpdate" value="`+email+`">
                 </div>
              </form>
              </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="onUpdateClick()">Save changes</button>
        </div>
      </div>
    </div>`;

    
             }     
           
        })
    }
}
var script = new script;
script.initialize();



const onUpdateClick = ()=>{
    userId = document.getElementById("updateUser").dataset.userid;
   console.log(document.getElementById("firstnameUpdate").value);
        $.ajax({
             method :'POST',
             data : {
                userId : userId,
                firstName : document.getElementById("firstnameUpdate").value,
                lastName : document.getElementById("lastnameUpdate").value,
                email : document.getElementById("emailUpdate").value
             },
             url : 'update-user.php',
             dataType : 'json',
             success: function(data) {
                        if(data.status){
                            if(confirm(data.message)){
                                location.reload();
                            }
                        }
                        
                    }
 
        

        })

    }
</script>
</html>