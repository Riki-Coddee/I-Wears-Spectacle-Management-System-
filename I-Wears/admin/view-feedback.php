
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

$sql ="SELECT * FROM `feedback`";

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
              if(in_array('userOrders_view',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                        <div class="column column-10">
                             <h1 class="adminInsertHeading"><i class="fa fa-list"></i>List of User Feedbacks</h1>
                             <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Phone Number</th>
                                             <th>Country</th>
                                             <th>Review</th>
                                             <th>Experience</th>
                                             <th>Shared_at</th>
                                         
                                             <?php
                                        if(in_array('userfeedback_view',$admin['permission']) || in_array('userOrders_delete',$admin['permission'])){
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
                                
                                             <td class="firstName"><?php echo $row['name'] ?></td>
                                             <td class="firstName"><?php echo ($row['email']) ?></td>
                                             <td class="lastName"><?php echo $row['phone'] ?></td>
                                             <td class="lastName"><?php echo $row['country']?></td>
                                             <td class="price"><?php echo $row['review'] ?></td>
                                             <td class="lastName"><?php echo $row['experience'] ?></td>
                                             <td class="lastName"><?php echo $row['created_at'] ?></td>
                                             <td><?php if(in_array('userfeedback_edit',$admin['permission']) ){
                                                    ?>
                                                <div><a href=""  class="updateProduct" ><i class="fa fa-check"></i>Completed</a>
                                               </div>
                                               <?php
                                                }
                                               ?>
                                               <?php if(in_array('userfeedback_delete',$admin['permission']) ){
                                                    ?>
                                               <div> 
                                               <a href="" class="deleteOrdered" data-feedback-id="<?php echo $row['id'] ?>" data-email="<?php echo $row['email'] ?>"><i class="fa fa-trash"></i>Delete</a>
                                               <div>
                                                <?php
                                               }
                                                ?>
                                             </td>
                                        
                                             </tr> 
                                             
                                             <?php 
                                            $index++;
                                            } ?>
                            
                                              
                                            
                                        </tbody>
                                     </table>
                                </div>
                             </div>
                             <p class="countUsers"><?php  echo mysqli_num_rows($result).' USER FEEDBACKS'; ?></p>
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
                       dltAlert =  document.getElementById("dltAlert");
            
          
          
                              if(classList.contains('deleteOrdered')){
                                    e.preventDefault();
                                    feedbackId = targetElement.dataset.feedbackId;
                                    email = targetElement.dataset.email;
                                            if (window.confirm('Delete feedback of'+' '+email+'?')) {
                                                        $.ajax({
                                                            method: 'POST',
                                                            data: {
                                                            id: feedbackId,
                                                            table : 'feedback'
                                                            },
                                                            url: 'delete.php',
                                                            dataType: 'json',
                                                            success: function(data) {
                                                            status =  data.status? "Success" : "Error";;
                                                            statusAlert = data.status?"success" : "danger";
                                                            message = data.status? "Feedback of"+" "+email+" "+"has been successfully deleted." : "Error processing your request" ;
                                                                dltAlert.innerHTML = `
                                                                <div class="alert alert-`+statusAlert+` alert-dismissible fade show" role="alert">
                                                                <strong>`+status+`!</strong>`+` `+message +`.
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="reload()" aria-label="Close"></button>
                                                                </div>`;
                                                                            }
                                                        })
                                            }
                             }

                            if(classList.contains('updateProduct')){
                                e.preventDefault();
                                usercartId = targetElement.dataset.usercartid;
                                productName = targetElement.dataset.productname;
                                first_name = targetElement.dataset.userfirstname;
                                last_name = targetElement.dataset.userlastname;
                                if (window.confirm(productName+' '+'has been successfully delivered to'+' '+first_name+' '+last_name+'. Do you want to update user cart?')) {
                                            $.ajax({
                                                method: 'POST',
                                                data: {
                                                id: usercartId,
                                                table : 'usercart'
                                                },
                                                url: 'delete.php',
                                                dataType: 'json',
                                                success: function(data) {
                                                    status =  data.status? "Success" : "Error";;
                                                    statusAlert = data.status?"success" : "danger";
                                                    message = data.status? productName+" "+"has been successfully updated from "+" "+first_name+" "+last_name+" "+"cart." : "Error processing your request" ;
                                                    dltAlert.innerHTML = `
                                                    <div class="alert alert-`+statusAlert+` alert-dismissible fade show" role="alert">
                                                    <strong>`+status+`!</strong>`+` `+message +`.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="reload()" aria-label="Close"></button>
                                                    </div>`;
                                                                }
                                        })
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

</script>
</html>


  