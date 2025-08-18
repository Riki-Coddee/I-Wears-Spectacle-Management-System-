
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap css  -->
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css">
    <link rel="stylesheet" href="Iwear_css/bootstrap.min.css.map">
    <!-- css  -->
    <link rel="stylesheet" href="Iwear_css/iwear.css">
    <link rel="stylesheet" href="Iwear_css/footer.css">
    <link rel="stylesheet" href="Iwear_css/product.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="icon" href="image/Black White Bold Business Logo.jpg" type="image/iwear-logo">
    <title>Our Products</title>
</head>

<body>
<title>Document</title>
<?php session_start();
    include 'partials/header.php';
    include 'php/database.php';
    
    $sql = "SELECT products.id,products.img FROM products ORDER BY RAND() LIMIT 5;";
    $result = mysqli_query($conn, $sql);
    $firstimg = true;
    ?>
    <div class="productContainer">
        
        <div id="productHeader-wrapper">
                <div class="productheader">
                    <div class="header-wrapper">
                    <img src="image/contactheader.jpeg" alt="">
                    </div>
                </div>
        </div>

        <!-- <div class="slider" data-carousel>
                        <button class="carousel-button prev" data-carousel-button="prev">&lArr;</button>
                        <button class="carousel-button next" data-carousel-button="next">&rArr;</button>
                        <ul data-slides> 
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            
                                
                            ?>
                            
                            <li class="slide" <?= ($firstimg ? 'data-active' : ''); ?> >
                            <a href="productbuy.php?id=<?=$row['id']; ?>">
                            <img src="admin/uploads/<?= $row['img']?>" alt="" >
                            </a>
                            </li>
                           <?php $firstimg = false; 
                             
                                }
                                         
                           ?>
                        </ul>
             </div> -->

                        <section>
        <div class="product-container">
                        <div class="mainThree rectangle-category">
                            <h1 class="seller category-h1">Rectangle Spectacles</h1>
                            <div class="flexThree">
                            
                                <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                            if($row['category'] === 'Rectangle-Shaped Spectacles'){
                                                                

                                        ?>
                                <div class="ThirdImg product-col">
                                    <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a>
                                    
                                </div>
                              <?php
                                            }
                                        
                              }
                              ?>
                            </div>
                       </div>
                       
                       
                       <div class="mainThree rectangle-category">
                            <h1 class="seller category-h1">Round Spectacles</h1>
                            <div class="flexThree">
                            
                                <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['category'] === 'Round-Shaped Spectacles'){
                                                                

                                        ?>
                                <div class="ThirdImg product-col">
                                    <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a>
                                </div>
                              <?php
                                            }
                              }
                              ?>
                            </div>
                       </div>
                       <div class="mainThree rectangle-category">
                            <h1 class="seller category-h1">Aviator Spectacles</h1>
                            <div class="flexThree">
                                
                                <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['category'] === 'Aviator Spectacles'){
                                                
                                                
                                                ?>
                                <div class="ThirdImg product-col">
                                    <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a> 
                                </div>
                                <?php
                                            }
                                        }
                                        ?>
                            </div>
                        </div>
                       <div class="mainThree rectangle-category">
                           <h1 class="seller category-h1">Square Spectacles</h1>
                           <div class="flexThree">
                               
                                <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['category'] === 'Square-Shaped Spectacles'){
                                                

                                        ?>
                                <div class="ThirdImg product-col">
                                    <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a> 
                                </div>
                                <?php
                                            }
                              }
                              ?>
                            </div>
                       </div>
                       <div class="mainThree rectangle-category">
                           <h1 class="seller category-h1">Cat-eye Spectacles</h1>
                           <div class="flexThree">
                               
                               <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['category'] === 'Cat-eye Spectacles'){
                                                
                                                
                                                ?>
                                <div class="ThirdImg product-col">
                                    <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a> 
                                </div>
                                <?php
                                            }
                                        }
                                        ?>
                            </div>
                        </div>
                        <div class="mainThree rectangle-category">
                           <h1 class="seller category-h1">Asymmetric Spectacles</h1>
                           <div class="flexThree" id="productLists">
                               
                               <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['category'] === 'Asymmetric Spectacles'){
                                                
                                                
                                                ?>
                                <div class="ThirdImg product-col">
                                    <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a> 
                                </div>
                                <?php
                                            }
                                        }
                                        ?>
                            </div>
                        </div>
                        <div class="mainThree rectangle-category">
                             <h1 class="seller category-h1">Customized Spectacles</h1>
                             <div class="flexThree">
                             
                                 <?php include 'php/database.php';
                                         $sql= "SELECT * FROM `products`";
                                         $result=mysqli_query($conn, $sql);
                                         while ($row = mysqli_fetch_assoc($result)) {
                                             if($row['category'] === 'Customized Spectacles'){
                                                                 
 
                                         ?>
                                 <div class="ThirdImg product-col">
                                    <a href="productbuy.php?id=<?=$row['id']?>"> <img src="./admin/uploads/<?=$row['img']?>" alt="">
                                     <h2><?= $row['product_name'] ?></h2></a>
                                 </div>
                               <?php
                                             }
                               }
                               ?>
                             </div>
                        </div>
                        <div class="mainThree rectangle-category">
                            <h1 class="seller category-h1">New Features</h1>
                            <div class="flexThree">
                            
                                <?php include 'php/database.php';
                                        $sql= "SELECT * FROM `products`";
                                        $result=mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['category'] === 'Other New Feature Spectacles'){
                                                                

                                        ?>
                                <div class="ThirdImg product-col">
                                   <a href="productbuy.php?id=<?=$row['id']?>"><img src="./admin/uploads/<?=$row['img']?>" alt="">
                                    <h2><?= $row['product_name'] ?></h2></a> 
                                </div>
                              <?php
                                            }
                              }
                              ?>
                            </div>
                       </div>
        
        
        </div>
</section>

<?php include 'partials/footer.php'; ?>
    </div>

</body>
<script src="javascript/product.js"></script>
<script>

if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }
</script>


       
      <!-- bootstrap Javascript  -->
<script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>

</html>