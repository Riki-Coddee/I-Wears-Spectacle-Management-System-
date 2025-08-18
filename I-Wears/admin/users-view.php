
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
$admin = $_SESSION["admin"];
$admin['permission'] = explode (',',$admin['permission']);
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
include "../php/database.php"; 

  
    $sql ="SELECT * FROM `login_table`";
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
              if(in_array('user_view',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                        <div class="column column-10">
                             <h1 class="adminInsertHeading"><i class="fa fa-list"></i>List of Users</h1>
                             <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                             <th>First Name</th>
                                             <th>Last Name</th>
                                             <th>Email</th>
                                             <th>Created At</th>
                                             <th>Updated At</th>
                                             <?php
                                        if(in_array('user_edit',$admin['permission']) || in_array('user_delete',$admin['permission'])){
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
                                             <td class="firstName"><?php echo $row['first_name'] ?></td>
                                             <td class="lastName"><?php echo $row['last_name'] ?></td>
                                             <td class="email"><?php echo $row['email'] ?></td>
                                             <td><?php echo date('F d,Y 0 H:i:s A', strtotime($row['created_at'])) ?></td>
                                             <td><?php echo date('F d,Y 0 H:i:s A', strtotime($row['updated_at'])) ?></td>  
                                             <td>
                                             <?php if(in_array('user_edit',$admin['permission']) ){
                                                    ?>
                                                <div><a href=""  class="updateUser" data-userid="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#exampleModal" id="updateUser"><i class="fa fa-pencil"></i>Edit</a>
                                               </div>
                                               <?php
                                             }
                                               ?>
                                                <?php if(in_array('user_delete',$admin['permission']) ){
                                                    ?>
                                               <div> 
                                               <a href="" class="deleteUser" data-userid="<?= $row['id']?>" data-fname="<?=$row['first_name']?>" data-lname="<?= $row['last_name']?>"><i class="fa fa-trash"></i>Delete</a>
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
                             <p class="countUsers"><?php  echo mysqli_num_rows($result).' USERS'; ?></p>
                        </div>
                    </div>
                    

               
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
                userId = targetElement.dataset.userid;
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
                 <div>
                    <input type="hidden" value="`+userId+`" id="ssschangesUserId">
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
    userId = document.getElementById("ssschangesUserId").value;
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