const logBtn=document.querySelector(".login_btn");
const closeLoginBtn= document.getElementById("closeLoginBtn");
const loginOverlay=document.querySelector(".login_overlay");
 
logBtn.addEventListener("click",()=>{
    
    
    
    loginOverlay.classList.add("active");
     document.body.style.overflow = "hidden";
     signupOverlay.classList.remove("active");
     
})
 
closeLoginBtn.addEventListener("click",()=>{
    let loginOverlay=document.querySelector(".login_overlay");
    
    loginOverlay.classList.remove("active");
    document.body.style.overflow = "visible";
 
})

  
