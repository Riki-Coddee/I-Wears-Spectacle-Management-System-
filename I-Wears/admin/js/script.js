const dashboardSidebar =document.querySelector(".dashboard-sidebar");
const dashboardContentsContainer =document.querySelector(".dashboard-contents_Container");
const dashboardSidebarUsers =document.querySelector(".dashboard-sidebar-users");
let sideBarIsOpen = true;
let mainMenuIconArrow2 = document.getElementsByClassName("mainMenuIconArrow");

adminPanelToggleBtn.addEventListener("click", (event)=>{
    event.preventDefault();
   if(sideBarIsOpen){
    dashboardSidebar.style.width ="10%";
    dashboardContentsContainer.style.width ="90%";
    adminpanelLogo.style.fontSize ="30px";
    for (let i = 0; i < mainMenuIconArrow2.length; i++) {
        mainMenuIconArrow2[i].style.paddingRight = "0px";
    }
    let menuIcons = document.getElementsByClassName("menuIcons");
    for(let i=0; i<menuIcons.length; i++ ){
        menuIcons[i].style.display = "none";
    }
    
    let dashboardSidebarMenus = document.getElementsByClassName("dashboard-sidebar-menus-lists");
    
    for(let i=0; i<dashboardSidebarMenus.length; i++ ){
        dashboardSidebarMenus[i].style.textAlign = "center";
    }
    dashboardSidebarUsers.style.textAlign= "left";
    sideBarIsOpen = false;
}

else{
    dashboardSidebar.style.width ="20%";
    dashboardSidebar.style.transition ="0.3s all ease-in-out";
    dashboardContentsContainer.style.width ="80%";
    adminpanelLogo.style.fontSize ="50px";
    for (let i = 0; i < mainMenuIconArrow2.length; i++) {
        mainMenuIconArrow2[i].style.paddingRight = "10px";
    }
    let menuIcons = document.getElementsByClassName("menuIcons");
    for(let i=0; i<menuIcons.length; i++ ){
        menuIcons[i].style.display = "inline-block";
    }
    
    let dashboardSidebarMenus = document.getElementsByClassName("dashboard-sidebar-menus-lists");
    
    for(let i=0; i<dashboardSidebarMenus.length; i++ ){
        dashboardSidebarMenus[i].style.textAlign = "left";
    }
    dashboardSidebarUsers.style.textAlign= "center";
    sideBarIsOpen = true;
}

})