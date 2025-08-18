<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Wears - About Us</title>
    <!-- Boostrap css  -->
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css.map">
    <!-- css  -->
    <link rel="stylesheet" href="Iwear_css/iwear.css">
    <link rel="stylesheet" href="Iwear_css/about.css">
    <link rel="stylesheet" href="Iwear_css/footer.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="icon" href="image/Black White Bold Business Logo.jpg" type="image/iwear-logo">
</head>
<body>
<?php 
session_start();
include 'partials/header.php'; ?>
    <section>
        <div class="aboutMain">
            <img src="./image/Black White Bold Business Logo.jpg" alt="">
            <p>Established in 2019 as a spectacles store in Kathmandu, I-Wears has since expanded its presence to 15 countries  and embraced online<br> orders,  transforming into a global eyewear destination. Offering an extensive range of 25 categories  of spectacles and <br>   catering to diverse tastes, I-Wears stands out by accommodating custom orders, enabling customers to <br>  curate their individual style. Committed to authenticity and innovation, I-Wears continues to lead the eyewear<br> industry, providing unparalleled choices and experiences while setting<br>
            new standards for quality and service. </p>
            <button class="btn2"><a href="#">More Info</a></button>
        </div>
        
        <div class="staff">
            <h1>Our Staffs</h1>
            <div class="staffFlex">
                <div class="imgName">
                    <img src="./image/owner.jpg" alt="">
                    <h3>Founder</h3>
                    <p>Rikesh Shrestha</p>
                </div>
                <div class="imgName">
                    <img src="./image/degineHead.jpg" alt="">
                    <h3>Designer Head</h3>
                    <p>Emma White</p>
                </div>
                <div class="imgName">
                    <img src="./image/assistancedesigner.jpg" alt="">
                    <h3>Assistance Designer</h3>
                    <p>Alisha Lehmann</p>
                </div>
                <div class="imgName">
                    <img src="./image/businessmanager.jpg" alt="">
                    <h3>Manager</h3>
                    <p>Susan Watson</p>
                </div>
                <div class="imgName">
                    <img src="./image/salesmanager.jpg" alt="">
                    <h3>Sales Manager</h3>
                    <p>Sophia Sheldon</p>
                </div>
                <div class="imgName">
                    <img src="./image/CO FOUNDER.jpg" alt="">
                    <h3>Co-Founder</h3>
                    <p>Chris Martin</p>
                </div>
            </div>
        </div>
    </section>
    
       <?php include 'partials/footer.php'; ?>
   
</body>
<!-- bootstrap Javascript  -->
<script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>
</html>