const signupBtn=document.querySelector(".signup_btn");
const closeSignupBtn= document.getElementById("closesignupBtn");
const signupOverlay=document.querySelector(".signup_overlay");
signupBtn.addEventListener("click",()=>{
    
    
    signupOverlay.classList.add("active");
    document.body.style.overflow = "hidden";
    loginOverlay.classList.remove("active");
    console.log("hello");
})
 
closeSignupBtn.addEventListener("click",()=>{
    let signupOverlay=document.querySelector(".signup_overlay");
    
    signupOverlay.classList.remove("active");
    document.body.style.overflow = "visible";
})

    // const signup_btn= document.getElementById("signup_submit_id");
    // const signup_username = document.getElementsByName("username")[0];
    //     const signup_password = document.getElementsByName("password")[0];
    // const signup_cpassword= document.getElementsByName("cpassword")[0];

    // const signup_form = signupOverlay.getElementsByTagName("form");
    
    // signup_btn.addEventListener("click",()=>{
        
        
    //    let signup_username_value = signup_username.value;
    //    console.log(signup_username_value)
    //     let signup_password_value = signup_password.value;
    //     console.log(signup_password_value)
    //     let  signup_cpassword_value = signup_cpassword.value;
    //     console.log(signup_cpassword_value);
    //     if((signup_password_value)===(signup_cpassword_value)){
           
    //        document.getElementById("myForm").action = "/I-Wears/signupform.php";

    //     }
    //     else{

 
    //     <div class="alert alert-success alert-dismissible fade show " role="alert">
    //     <strong>Success!</strong> Your account is now created.
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>

    //     }
    // })