
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
$admin = $_SESSION['admin'];
$admin['permission'] = explode (',',$admin['permission']);
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) header("location: admin.php");
include "../php/database.php"; 
$showAlert = false;
$showError = false;

    $sql ="SELECT order_product.id, order_product.product, products.product_name, order_product.quantity_ordered, order_product.quantity_received, admin.first_name, admin.last_name, order_product.batch,  suppliers.supplier_name, order_product.status, order_product.created_at  FROM order_product, suppliers, products, admin WHERE order_product.supplier = suppliers.id AND order_product.product = products.id AND order_product.created_by= admin.id";
    $result = mysqli_query($conn, $sql);
    $data = [];



    
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
    

<!-- Modal for update purchase order-->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
  <!-- fill in modal dynamically using js for alerting product updation -->
  </div>
</div>

<!-- Modal for -->
<div class="modal fade" id="deliveryHistoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="deliveryHistory-dialog">
  <!-- fill in modal dynamically using js for alerting product updation -->
  </div>
</div>


    <div id="dashboardMainContainer">
        <?php include "adminpartials/adminsidebar.php"; ?>
        <div class="dashboard-contents_Container">
            
            <?php include "adminpartials/admintopnov.php"; ?>
            <?php
              if(in_array('po_view',$admin['permission'])){
                  ?>
            <div class="dashboard-contents">
                <div class="dashboard-contents_main">
                    <div class="row">
                        <div class="column column-10">
                             <h1 class="adminInsertHeading"><i class="fa fa-list"></i>List of Purchase Order</h1>
                             <div class="section_content">
                                 <div class="users">
                                    <?php
                                       while ($row = mysqli_fetch_assoc($result)) {
                                        $data[$row['batch']][] = $row;
                                        
                                       }
                                        foreach ($data as $batch_id => $batch_pos) {
                                            # code...
                                       
                                        
                                    ?>
                                    <div class="poListContainers">
                                        <div class="poList" id="conatiner-<?= $batch_id ?>">
                                            <p>Batch #: <?=  $batch_id ?>  </p>
                                                  
                                                        
                                      <table> 
                                                 <thead>
                                                     <tr>
                                                              <th>#</th>
                                                              <th>product</th>
                                                              <th>qty ordered</th>
                                                              <th>qty received</th>
                                                              <th>supplier</th>
                                                              <th>status</th>
                                                              <th>Ordered By</th>
                                                              <th>Created Date</th>
                                                              <th>Delivery History</th>
                                                      </tr>
                                                                 </thead>
                                                                         <tbody>
                                                                            <?php
                                                                            foreach ($batch_pos as $index => $batch_po){
                                                                            ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td class="po_product"><?= $batch_po['product_name'] ?></td>
                                                    <td class="po_qty_ordered"><?= $batch_po['quantity_ordered'] ?></thd>
                                                    <td class="po_qty_received"><?= $batch_po['quantity_received'] ?></thd>
                                                    <td class="po_qty_supplier"><?= $batch_po['supplier_name'] ?></td>
                                                    <td class="po_qty_status"><span class="po-badge po-badge-<?= $batch_po['status'] ?>"><?= $batch_po['status'] ?></span></td>
                                                    <td><?= $batch_po['first_name']." ".$batch_po['last_name']  ?></td>
                                                    <td><?= $batch_po['created_at'] ?>
                                                    <input type="hidden" class="po_qty_row_id" value="<?= $batch_po['id'] ?>">
                                                    <input type="hidden" class="po_qty_product_id" value="<?= $batch_po['product'] ?>">
                                                    </td>
                                                    <td><button class="appBtn appDeliveryHistoryBtn" data-id="<?= $batch_po['id'] ?>" data-bs-toggle="modal" data-bs-target="#deliveryHistoryModal">Show Delivery History</button></td>
  
                                                </tr>
                                               <?php } ?>
                                            </tbody>
                                     </table>
                                     <?php if(in_array('po_edit',$admin['permission']) ){
                                                    ?>
                                     <div class="poOrderUpdateBtnConatiner align-text">
                                    <button class="appBtn updatePoBtn" data-id="<?= $batch_id ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
                                </div>
                                <?php
                                     }
                                ?>
                                </div>
                                <?php
                                     }
                                    
                                   
                                ?>
                                      
                       </div>
                             <p class="countUsers"><?php  echo mysqli_num_rows($result).' PURCHASE ORDER'; ?></p>
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
    var vm = this;
    modalDialog =  document.getElementById("modal-dialog");
    deliveryHistoryDialog =  document.getElementById("deliveryHistory-dialog");
                       dltAlert =  document.getElementById("dltAlert");
      this.initialize = function(){
        this.registerEvents();
                                },
         this.registerEvents = function(){
            document.addEventListener('click', function(e){
                       targetElement = e.target;
                       classList = targetElement.classList;
                       modalDialog =  document.getElementById("modal-dialog");
                       dltAlert =  document.getElementById("dltAlert");
            
          
          
                              if(classList.contains('updatePoBtn')){
             e.preventDefault();
             batchNumber = targetElement.dataset.id;
             batchNumberContainer= 'conatiner-'+targetElement.dataset.id;
           

             productList = document.querySelectorAll('#'+batchNumberContainer+' .po_product')  
              qtyOrderedList = document.querySelectorAll('#'+batchNumberContainer+' .po_qty_ordered')
             qtyReceivedList = document.querySelectorAll('#'+batchNumberContainer+' .po_qty_received')
             supplierList = document.querySelectorAll('#'+batchNumberContainer+' .po_qty_supplier')
             statusList = document.querySelectorAll('#'+batchNumberContainer+' .po_qty_status')
             rowIds = document.querySelectorAll('#'+batchNumberContainer+' .po_qty_row_id')
             productIds = document.querySelectorAll('#'+batchNumberContainer+' .po_qty_product_id')
             
             poListArr = [];
             for (let i = 0; i < productList.length; i++) {
               poListArr.push({
                name: productList[i].innerText,
                qtyOrdered: qtyOrderedList[i].innerText,
                qtyReceived: qtyReceivedList[i].innerText,
                supplier: supplierList[i].innerText,
                status: statusList[i].innerText,
                id: rowIds[i].value,
                pId: productIds[i].value,
               })
                
             }
             
             
            


             var poListHtml = `
                                 
             <table id="formTable_`+targetElement.dataset.id+`"> 
                                                 <thead>
                                                     <tr>
                                                              <th>Product Name</th>
                                                              <th>Qty ordered</th>
                                                              <th>Qty received</th>
                                                              <th>Qty delivered</th>
                                                              <th>Supplier</th>
                                                              <th>Status</th>
                                                             
                                                      </tr>
                                                                 </thead>
                                                                         <tbody>`;
                                                                            poListArr.forEach((poList) => {
                                                                            poListHtml += `
                                                                            
                                                <tr>
                                                    
                                                    <td class="po_product">`+poList.name+`</td>
                                                    <td class="po_qty_ordered">`+poList.qtyOrdered+`</td>
                                                    <td class="po_qty_received">`+poList.qtyReceived+`</td>
                                                    <td class="po_qty_delivered"><input type="number" value="0"></td>
                                                    <td class="po_qty_supplier">`+poList.supplier+`</td>
                                                    <td >
                                                        <select class="po_qty_status">
                                                            <option value="pending"`+((poList.status ==="pending" )? "selected" : "")+` >pending</option>
                                                            <option value="incomplete"`+((poList.status ==="incomplete" )? "selected" : "")+` >incomplete</option>
                                                            <option value="complete" `+((poList.status ==="complete" )? "selected" : "")+`>complete</option>
                                                            </select>
                                                    <input type="hidden" class="po_qty_row_id" value="`+poList.id+`">
                                                    <input type="hidden" class="po_product_id" value="`+poList.pId+`">
                                                    </td>

                                                </tr>`; 
                                                                            });
                             poListHtml +=`  </tbody>
                                     </table>`;
                                            
            
        
        
                                     showEditDialog(poListHtml);
                    
                                    } 
            
                                    if (classList.contains('appDeliveryHistoryBtn')) {
                id = targetElement.dataset.id;
                $.get('../php/view-delivery-history.php',{id : id}, function (data) {
                    rows = '';
                    data.forEach((row, id) => {
                        receiveDate = (new Date(row['date_received']));
                        rows += `<tr>
                                                    <td>`+id+1 +`</td>
                                                    <td>`+receiveDate.toUTCString()+` `+receiveDate.getUTCHours()+`:`+receiveDate.getUTCMinutes()+`</td>
                                                    <td>`+row['qty_received']+`</td>
                                                    </tr>`;
                    });
                   if(data.length){
                    deliveryHistoryDialog.innerHTML = `
    <div class="modal-content modal_content_bs">
        <div class="modal-header modal_header_bs">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update <strong>Update Purchase Order: Batch #:`+targetElement.dataset.id+`<strong></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
            <div class="dashboard-update_model showDeliveryModal">
                <table>
                <thead>
                                                     <tr>
                                                              <th>#</th>
                                                              <th>Date Received</th>
                                                              <th>Qantity received</th>
                                                              
                                                             
                                                      </tr>
                                                                 </thead>
                                                                         <tbody>
                                                                            
                                                                            `+rows+`
                                                    
                               </tbody>
                                     </table>
              </div>
              
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="onUpdateClick()">Save changes</button>
          
        </div>
      </div>
    </div>`;
                   }
                   else{
                    deliveryHistoryDialog.innerHTML = `
    <div class="modal-content modal_content_bs">
        <div class="modal-header modal_header_bs">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update <strong>Update Purchase Order: Batch #:`+targetElement.dataset.id+`<strong></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
            <div class="dashboard-update_model showDeliveryModal">
               <p>No data Found.</p>
              </div>
              
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="onUpdateClick()">Save changes</button>
          
        </div>
      </div>
    </div>`;
                   }
                }, 'json');
            }
                                })
         


           
        }
    }
    

var script = new script;
script.initialize();
  

const onUpdateClick = ()=>{
 
        formTableConatainer = 'formTable_'+ batchNumber;
        qtyReceivedList = document.querySelectorAll('#'+formTableConatainer+' .po_qty_received')
        qtyDeliveredList = document.querySelectorAll('#'+formTableConatainer+' .po_qty_delivered input')
        qtyOrderedList = document.querySelectorAll('#'+formTableConatainer+' .po_qty_ordered')
         statusList = document.querySelectorAll('#'+formTableConatainer+' .po_qty_status')
             rowIds = document.querySelectorAll('#'+formTableConatainer+' .po_qty_row_id')
             productIds = document.querySelectorAll('#'+formTableConatainer+' .po_product_id')
             console.log(productIds);
             poListArrForm = [];
             for (let i = 0; i < qtyReceivedList.length; i++) {
               poListArrForm.push({
                productId : productIds[i].value,
                qtyReceive: qtyReceivedList[i].innerText,
                qtyDelivered: qtyDeliveredList[i].value,
                qtyOrdered :  qtyOrderedList[i].innerText,
                status: statusList[i].value,
                id: rowIds[i].value,
               })
                
             }
             console.log(poListArrForm);
             
       
        $.ajax({
            url: '../php/update-order.php',
            method: 'POST',
            data: {payload:poListArrForm},
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
                      
            modalDialog.innerHTML = `
    <div class="modal-content modal_content_bs">
        <div class="modal-header modal_header_bs">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update <strong>Update Purchase Order: Batch #:`+targetElement.dataset.id+`<strong></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="dashboard-update_model">
                `+poListHtml+`
              </div>
              
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="onUpdateClick()">Save changes</button>
          
        </div>
      </div>
    </div>`;
                }
            }
           
        });
    

    }




    function showEditDialog(poListHtml){
   
            modalDialog.innerHTML = `
    <div class="modal-content modal_content_bs">
        <div class="modal-header modal_header_bs">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update <strong>Update Purchase Order: Batch #:`+targetElement.dataset.id+`<strong></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="dashboard-update_model">
                `+poListHtml+`
              </div>
              
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="onUpdateClick()">Save changes</button>
          
        </div>
      </div>
    </div>`;
      
    }
</script>
</html>


  