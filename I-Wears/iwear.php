
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Wears - Home</title>
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css.map">
    <!-- css  -->
    <link rel="stylesheet" href="Iwear_css/iwear.css">
    <link rel="stylesheet" href="Iwear_css/footer.css">
     
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">

    <link rel="icon" href="image/Black White Bold Business Logo.jpg" type="image/iwear-logo">
</head>
<body>
 <?php
       session_start();
       include "php/database.php";
       include 'partials/header.php';
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
//       header("location: partials/login.php");
//       exit;
//    }
   ?>

    <section>
        <div class="main">
            <h1>Fashion fade, <br>
            Style is eternal</h1>
            <button><a href="product.php" class="btn">Check out</a></button>
    
        </div>

        <div class="mainThree">
            <h1 class="seller">What we sell</h1>
            <div class="flexThree">
                <div class="ThirdImg">
                    <img src="./image/sun glasses.jpg" alt="">
                    <h2>Sun Glasses</h2>
                </div>
                <div class="ThirdImg">
                    <img src="./image/eyeGlasses.jpg" alt="">
                    <h2>Eye Glasses</h2>
                </div>
                <div class="ThirdImg">  
                    <img src="./image/custom.jpg" alt="">    
                    <h2>Custom Orders</h2>
                </div>
            </div>
        </div>

        <div class="quote">
            <h2>Better eyes for a better life.</h2>
        </div>

        <div class="productMain">
            <h1>Check out our new product</h1>
            <hr class="line">
            <div class="flexThree">
                <div class="textLeft">
                    <h2>Rectangle Shade (White)</h2>
                    <p>Rectangle shade are the most popular and trending shade among teenagers. <br>
                    Iwear provides the most authentic and high quality shades.</p>
                    <button><a href="product.php" class="btn">Buy Now</a></button>
                </div>
                <div class="imgRight">
                    <img src="./image/My project.png" alt="">
                </div>
            </div>
        </div>

       
       
    </section>
<?php include 'partials/footer.php'; ?> 


<!-- bootstrap Javascript  -->
<script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>
  
<!-- fontawesome  -->
<script src="https://kit.fontawesome.com/f2fbfcb494.js"></script>
</body>
</html>