
<div class="dashboard-sidebar">
<h1 class="adminpanelLogo" id="adminpanelLogo">I-Wears</h1>
<div class="dashboard-sidebar-users">
    <img src="image/Male Icon Clipart Transparent Background, Business Male Icon Vector, Business Icons, Male Icons, Job Clipart PNG Image For Free Download.jpeg" alt="" id="adminProfileImage">
 
<?php
        echo'<span>'.$_SESSION["admin"]['first_name'].'</span>';
?>
</div>
<div class="dashboard-sidebar-menus">
    <ul class="dashboard-sidebar-menus-lists">
    <!-- class="menuActive" -->
        <li class="liMainMenu"><a href="./dashboard.php"><i class="fa fa-dashboard"></i><span class=" menuIcons">Dashboard</span></a></li>
        <li class="liMainMenu"><a href="./report.php"><i class="fa fa-file"></i><span class=" menuIcons">Reports</span></a></li>
        <li class="liMainMenu" id="productMgmBtn"><a href="javascript:void(0);"><i class="fa fa-tag" ></i><span class=" menuIcons">Product </span><i class="fa fa-angle-left  mainMenuIconArrow"></i></a>
            <ul class="subMenus">
                <li><a href="./product-view.php"><i class="fa fa-circle"></i>View Products</a></li>
                <li><a href="./product-add.php"><i class="fa fa-circle"></i>Add Product</a></li>
              </ul>
        </li>
        
        <li class="liMainMenu" id="supplierMgmBtn"><a href="javascript:void(0);"><i class="fa fa-truck" ></i><span class=" menuIcons">Supplier</span><i class="fa fa-angle-left  mainMenuIconArrow"></i></a>
            <ul class="subMenus">
                <li><a href="./suppliers-view.php"><i class="fa fa-circle"></i>View Suppliers</a></li>
                <li><a href="./supplier-add.php"><i class="fa fa-circle"></i>Add Supplier</a></li>
              </ul>
        </li>
        
        <li class="liMainMenu" id="orderMgmBtn"><a href="javascript:void(0);"><i class="fa fa-shopping-cart" ></i><span class=" menuIcons">Purchase Order </span><i class="fa fa-angle-left  mainMenuIconArrow"></i></a>
            <ul class="subMenus">
                <li><a href="./view-order.php"><i class="fa fa-circle"></i>View Orders</a></li>
                <li><a href="./product-order.php"><i class="fa fa-circle"></i>Create Order</a></li>
               
              </ul>
        </li>

        <li class="liMainMenu" id="userMgmBtn"><a href="javascript:void(0);"  ><i class="fa fa-user-plus"  ></i><span class="menuIcons" >User</span><i class="fa fa-angle-left mainMenuIconArrow"  ></i></a>
          <ul class="subMenus">
            <li><a href="./users-view.php"><i class="fa fa-circle"></i>View Users</a></li>
            <li><a href="./users-add.php"><i class="fa fa-circle"></i>Add User</a></li>
          </ul>  
    </li>

        <li class="liMainMenu" id="adminMgmBtn"><a href="javascript:void(0);"  ><i class="fa fa-lock"  ></i><span class="menuIcons" >Admin</span><i class="fa fa-angle-left mainMenuIconArrow"  ></i></a>
          <ul class="subMenus">
            <li><a href="./admins-view.php"><i class="fa fa-circle"></i>View Admins</a></li>
            <li><a href="./admin-add.php"><i class="fa fa-circle"></i>Add Admin</a></li>
          </ul>  
    </li>
        <li class="liMainMenu" id="userOrderMgmBtn"><a href="javascript:void(0);"  ><i class="fa fa-users"  ></i><span class="menuIcons" >User Orders</span><i class="fa fa-angle-left mainMenuIconArrow"  ></i></a>
          <ul class="subMenus">
            <li><a href="./userOrder-view.php"><i class="fa fa-circle"></i>View User Orders</a></li>
          </ul>  
    </li>
        <li class="liMainMenu" id="feedbackMgmBtn"><a href="javascript:void(0);"  ><i class="fa fa-comment"  ></i><span class="menuIcons" >Feedback</span><i class="fa fa-angle-left mainMenuIconArrow"  ></i></a>
          <ul class="subMenus">
            <li><a href="./view-userMsg.php"><i class="fa fa-circle"></i>View User Message</a></li>
            <li><a href="./view-feedback.php"><i class="fa fa-circle"></i>View User Feedback</a></li>
          </ul>  
    </li>
    </ul>
</div>
</div>

<script>
    let userMgm = document.getElementById('userMgmBtn');
    let productMgm = document.getElementById('productMgmBtn');
    let supplierMgm = document.getElementById('supplierMgmBtn');
    let orderMgm = document.getElementById('orderMgmBtn');
    let adminMgm = document.getElementById('adminMgmBtn');
    let userOrderMgm = document.getElementById('userOrderMgmBtn');
    let feedbackMgm = document.getElementById('feedbackMgmBtn');
    

           userMgm.addEventListener("click",(e)=>{
        let clickedE1 = e.target;
         let subMenu = clickedE1.closest('li').querySelector('.subMenus');
         let mainMenuIconArrow = clickedE1.closest('li').querySelector('.mainMenuIconArrow');
         showHideSubMenu(subMenu,mainMenuIconArrow,userMgm);
         })
            
           productMgm.addEventListener("click",(e)=>{
         let clickedE1 = e.target;
         let subMenu = clickedE1.closest('li').querySelector('.subMenus');
         let mainMenuIconArrow = clickedE1.closest('li').querySelector('.mainMenuIconArrow');
        
         showHideSubMenu(subMenu,mainMenuIconArrow,productMgm);

        

    })

           supplierMgm.addEventListener("click",(e)=>{
        let clickedE1 = e.target;
         let subMenu = clickedE1.closest('li').querySelector('.subMenus');
         let mainMenuIconArrow = clickedE1.closest('li').querySelector('.mainMenuIconArrow');
         showHideSubMenu(subMenu,mainMenuIconArrow,supplierMgm);    
    })

    orderMgm.addEventListener("click",(e)=>{
        let clickedE1 = e.target;
         let subMenu = clickedE1.closest('li').querySelector('.subMenus');
         let mainMenuIconArrow = clickedE1.closest('li').querySelector('.mainMenuIconArrow');
         showHideSubMenu(subMenu,mainMenuIconArrow,orderMgm);    
    })

    adminMgm.addEventListener("click",(e)=>{
        let clickedE1 = e.target;
         let subMenu = clickedE1.closest('li').querySelector('.subMenus');
         let mainMenuIconArrow = clickedE1.closest('li').querySelector('.mainMenuIconArrow');
         showHideSubMenu(subMenu,mainMenuIconArrow,adminMgm);    
    })
    userOrderMgm.addEventListener("click",(e)=>{
        let clickedE1 = e.target;
         let subMenu = clickedE1.closest('li').querySelector('.subMenus');
         let mainMenuIconArrow = clickedE1.closest('li').querySelector('.mainMenuIconArrow');
         showHideSubMenu(subMenu,mainMenuIconArrow,userOrderMgm);    
    })
    feedbackMgm.addEventListener("click",(e)=>{
        let clickedE1 = e.target;
         let subMenu = clickedE1.closest('li').querySelector('.subMenus');
         let mainMenuIconArrow = clickedE1.closest('li').querySelector('.mainMenuIconArrow');
         showHideSubMenu(subMenu,mainMenuIconArrow,feedbackMgm);    
    })

function showHideSubMenu(subMenu,mainMenuIconArrow,mainLiID){
    if(subMenu != null){
            if(subMenu.style.display === "block") {
                subMenu.style.display = 'none';
                mainMenuIconArrow.classList.remove('fa-angle-down');
                mainMenuIconArrow.classList.add('fa-angle-left');
                mainLiID.classList.remove("MainLi");
                subDivMenu.classList.remove("subDivMenu");
              }
              else {
                subMenu.style.display = 'block';
                mainLiID.classList.add("MainLi");
                sub.classList.add("subDivMenu");
                mainMenuIconArrow.classList.remove('fa-angle-left');
               
                mainMenuIconArrow.classList.add('fa-angle-down');

            }
         }
}
    
let pathArray = window.location.pathname.split('/');
let curFile = pathArray[pathArray.length - 1];
let curNav = document.querySelector('a[href="./'+curFile+'"]');


let mainNav = curNav.closest('li.liMainMenu');
mainNav.style.background = "rgb(163 17 17)";
let subDivMenu = curNav.closest("li");
subDivMenu.classList.add("subDivMenu");
let subMenu = mainNav.querySelector('.subMenus');
let mainMenuIconArrow = curNav.querySelector('.mainMenuIconArrow');
showHideSubMenu(subMenu,mainMenuIconArrow);




</script>
