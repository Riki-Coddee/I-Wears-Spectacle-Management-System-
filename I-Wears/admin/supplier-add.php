
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
$admin = $_SESSION['admin'];
$admin['permission'] = explode (',',$admin['permission']);
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
include "../php/database.php"; 
$_SESSION['table']='suppliers';
$_SESSION['redirect_to'] = 'supplier-add.php';

  
   

    
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
              if(in_array('supplier_create',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                    <div class="column column20">
                    <h1 class="adminInsertHeading"><i class="fa fa-plus"></i>Insert Supplier</h1>
                              <div id="adminAddFormConatiner">

                                    <form method="post" action="../php/add.php" action="addAdmin.php">
                                        <div class="adFormInputConatiner">
                                           <label for="supplier_name">Supplier Name</label>
                                           <input type="text" id="supplier_name" name="supplier_name" placeholder="Enter supplier name....">
                                         </div>
                                         <div class="adFormInputConatiner">
                                            <label for="supplier_location">Location</label>
                                             <input type="text" id="supplier_location" name="supplier_location" placeholder="Enter supllier location.....">
                                         </div>
                                         <div class="adFormInputConatiner">
                                             <label for="supplier_email">Email</label>
                                             <input type="email" id="supplier_email" name="email" placeholder="Enter supplier email.....">
                                         </div>
                                        
                                         <button type="submit" id="adFormBtn"><i class="fa fa-plus"></i>Add Supplier</button>
                                    </form>
                              </div>
                        
                     </div>
                        
                    
                      
                     <?php
    if(isset($_SESSION['showAlert']) && $_SESSION['showAlert'] == true){
    echo'
    <div class="addAdminSuccess">
        <p>Supplier has been successfully added.</p>
    </div>
    ';
    $_SESSION['showAlert'] = false;

    }
    if(isset($_SESSION['showError']) && $_SESSION['showError'] == true){
        echo'
        <div class="addAdminError">
            <p>Supplier cannot be added at the moment. Please try again with suitable information. </p>
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