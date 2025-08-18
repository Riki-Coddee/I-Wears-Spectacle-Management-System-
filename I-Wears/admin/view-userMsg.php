
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

    $sql ="SELECT * FROM `contact`";
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
              if(in_array('userMsg_view',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                        <div class="column column-10">
                             <h1 class="adminInsertHeading"><i class="fa fa-list"></i>List of Users Message</h1>
                             <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                             <th>Phone No.</th>
                                             <th>Email</th>
                                             <th>Subject</th>
                                             <th>Message</th>
                                             <th>Date</th>
                                             <?php
                                        if(in_array('userMsg_edit',$admin['permission']) || in_array('userMsg_delete',$admin['permission'])){
                                                    ?>
                                             <th>Action</th>
                                             <?php } ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr> 
                                            <?php
                                               $index = 1;
                                               while ($row = mysqli_fetch_assoc($result)) { 
                            
                                                   ?>
                                                    <tr> 
                                                <td><?php echo $index ?></td>
                                             
                                             <td class="supplierName"><?php echo $row['name'] ?></td>
                                             <td class="supplierLocation"><?php echo $row['phone'] ?></td>
                                             <td class="supplierLocation"><?php echo $row['email'] ?></td>
                                             <td class="supplierEmail"><?php echo $row['subject'] ?></td>
                                             <td class="createdBy"><?php echo $row['message'] ?></td>
                                             <td><?php echo date('F d,Y @ H:i:s A', strtotime($row['message_at'])) ?></td>
                                             <td>
                                                <?php if(in_array('userMsg_edit',$admin['permission']) ){
                                                    ?>
                                                <div><a href=""  class="updateSupplier" data-sid="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#exampleModal" id="updateProduct"><i class="fa fa-pencil"></i>Edit</a>
                                               </div>
                                               <?php
                                                }
                                               ?>
                                               <?php if(in_array('userMsg_delete',$admin['permission']) ){
                                                    ?>
                                               <div> 
                                               <a href="" class="deleteUserMessage" data-user-msg-id="<?= $row['id']?>" data-username="<?= $row['name']?>"  ><i class="fa fa-trash"></i>Delete</a>
                                               <div>
                                                <?php
                                               }
                                                ?>
                                             </td>
                                             </tr> 
                                             <?php $index++;} ?>
                            
                                              
                                            
                                        </tbody>
                                     </table>
                                </div>
                             </div>
                             <p class="countUsers"><?php  echo mysqli_num_rows($result).' USER MESSAGES'; ?></p>
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
<script defer src="../javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="../javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="../javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>




<?php
include "../php/database.php";
$sql= "SELECT * FROM `products`";
$result = mysqli_query($conn, $sql);
  $product_arr=[];

  while ($product= mysqli_fetch_assoc($result)) {
    $product_arr[$product['id']]= $product['product_name'];
  }

$product_arr= json_encode($product_arr);
?>    
<script>
const productsList = <?= $product_arr?>;



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
            
          
          
                              if(classList.contains('deleteUserMessage')){
             e.preventDefault();
             userMsgId = targetElement.dataset.userMsgId;
             userName = targetElement.dataset.username;
             if (window.confirm('Are you sure to delete message of'+' '+userName+'?')) {
                $.ajax({
                    method: 'POST',
                    data: {
                      id: userMsgId,
                      table : 'contact'
                    },
                    url: 'delete.php',
                    dataType : 'json',
                    success: function(data) {
                        status =  data.status? "Success" : "Error";;
                        statusAlert = data.status?"success" : "danger";
                        message = data.status? userName +"'s message "+"has been successfully deleted" : "Error processing your request" ;
                            dltAlert.innerHTML = `
                            <div class="alert alert-`+statusAlert+` alert-dismissible fade show" role="alert">
                           <strong>`+status+`!</strong>`+message +`.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="reload()" aria-label="Close"></button>
                           </div>
                                                `;
                                              

                        
                        
                    }
 
                })
             }
            }

                            if(classList.contains('updateSupplier')){
                e.preventDefault();
                 sid = targetElement.dataset.sid;
                 showEditDialog(sid);   }     
           
        
        
                      })
             }
}
var script = new script;
script.initialize();
  

const onUpdateClick = ()=>{
        
        var form = $("#updateForm")[0];
        var formData = new FormData(form);

        $.ajax({
            url: 'update-supplier.php',
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
        $.get("../php/get-supplier.php",{id: id}, function(supplierDetails) {
            let curSelectedProducts = supplierDetails['products'];
            let productOption = '';

            for(const[pId, pName] of Object.entries(productsList)) {
                  selected = curSelectedProducts.indexOf(pId) > -1 ? "selected" : ''; 
                productOption += "<option "+selected+" value="+pId+">"+pName+"</option>";
              
                
            }
            
            modalDialog.innerHTML = `
    <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update <strong>`+supplierDetails.supplier_name+`<strong></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="dashboard-update_model">
                <form method="post" action="../php/add.php" enctype="multipart/form-data" id="updateForm">
                    <div class="adFormInputConatiner">
                          <label for="supplier_name">Suuplier Name</label>
                         <input type="text" id="supplier_name" name="supplier_name" value="`+supplierDetails.supplier_name+`" >
                   </div>
            
                    <div class="adFormInputConatiner">
           <label for="supplier_location">Supplier Location</label>
           <input type="text" id="supplier_locatione" name="supplier_location" value="`+supplierDetails.supplier_location+`" >
         </div>

      
                    <div class="adFormInputConatiner">
                          <label for="supplier_email">Contact Information</label>
                                 <input type="text" id="supplier_email" name="email" value="`+supplierDetails.email+`" >
                    </div>
         
                    <div class="adFormInputConatiner">
                                             <label for="productss">Product</label>
                                            <select name="products[]" id="supplier" multiple>
                                                <option value="">Select Supplier</option>
                                                `+productOption+`
                                            </select>
                                            
                        </div>
                         
         
         <input type="hidden" value="`+supplierDetails.id+`" name="sid">
         
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


  