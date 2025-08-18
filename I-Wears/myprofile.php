<?php
session_start(); 
if(!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin']!=true){
header("Location:partials/login.php");
exit;
}
$user = $_SESSION['user'];
?>
<?php
include "php/database.php";
$updatedAlert = false;
$updatedError = false;

   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $review = $_POST['review'];
    $experience = $_POST['message'];

    // Prepare the SQL statement using a prepared statement
    $sql = "INSERT INTO `feedback` (`name`, `phone`, `email`, `country`, `review`,`experience`,`created_at`) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $name,  $phone, $email, $country, $review, $experience);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $updatedAlert = "You've successfully submitted your feedback. Thank you!";
        } else {
            $updatedError = "We're sorry, but there was an error submitting your feedback. Please try again later";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $updatedError = "Failed to prepare the statement";
    }
}
?>
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
    <link rel="stylesheet" href="Iwear_css/myprofile.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <title>My Profile</title>
</head>
<body>
    <?php include("partials/header.php");?>
    <?php


    if($updatedAlert!=false){
    echo '<div class="alert alert-success alert-dismissible fade show my-10 margin-top" role="alert">
          <strong>Success!</strong>'.' '.$updatedAlert.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if($updatedError!=false){
    echo '<div class="alert alert-danger alert-dismissible fade show margin-top" role="alert">
          <strong>Error!</strong>'.' '.$updatedError.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
    ?>
    <div class="myProfileContainer">
        <div class="myProfile">
            <div class="profileheader">
                <div class="header-wrapper">
                    <img src="image/contactheader.jpeg" alt="">
                </div>
            </div>
            <div class="myImg">
                <img src="image/userlogo.png" alt="">
            </div>
            <div class="myProfileContent">
                <div class="userName">
                    <p>Name :  <?= $user['first_name'].' '.$user['last_name'] ?></p>
                </div>
                <div class="userName">
                    <p>Email :  <?= $user['email'] ?></p>
                </div>
            </div>
            
            
                        <div class="dashboard-contents_main">
                                <ul class="box-info">
                                    <li>
                                        <i class="fa-solid fa-brands fa-product-hunt"></i>
                                        <span class="text">
                                            <h3><?php  include "php/database.php"; 
                                                $sql ="SELECT * FROM `wishlist` WHERE `user`='{$user['id']}'";
                                                $result = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($result) ?></h3>
                                            <p>Total Products in Your Wishlist</p>
                                        </span>
                                    </li><li>
                                        <i class="fa-solid fa-truck-field"></i>
                                        <span class="text">
                                            <h3><?php  include "php/database.php"; 
                                                $sql ="SELECT * FROM `usercart` WHERE `users`='{$user['id']}'";
                                                $result = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($result) ?></h3>
                                            <p>Total Products in Your Cart</p>
                                        </span>
                                
                                </ul>
                    </div>

                <div class="feedbackform">
                        <h2>Feedback Form</h2>
                        <form action="#" method="post">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            
                            <label for="email">Phone:</label>
                            <input type="text" max-length="10" id="phone" name="phone" required>
                            
                            <label>Select Country:</label>
                                <div  class="radioStyle">
                                    <input type="radio" id="Nepal" name="country" value="Nepal"> Nepal

                                    <input type="radio" id="india" name="country" value="India"> India
                    

                                    <input type="radio" id="china" name="country" value="China"> China
                    

                                    <input type="radio" id="usa" name="country" value="USA"> USA
    
                                   
                                    <input type="radio" id="uk" name="country" value="UK"> UK

                                    <input type="radio" id="aus" name="country" value="Australia"> Australia
                            
                                    
                                    <input type="radio" id="canada" name="country" value="Canada"> Canada
                            

                                    <input type="radio" id="england" name="country" value="England"> England
                                    
                                </div>
                             
                                <label>How was our service:</label>
                                <div class="radioStyle">
                                    <input type="radio" id="bad" name="review" value="Bad"> Bad
                                    

                                    <input type="radio" id="good" name="review" value="Good"> Good
                                    

                                    <input type="radio" id="average" name="review" value="Average"> Average
                                    

                                    <input type="radio" id="excellent" name="review" value="Excellent"> Excellent
                                    

                                    
                                </div>
                            <label for="message">Share Your Experience:</label>
                            <textarea id="message" name="message" required></textarea>

                            <input type="submit" value="Submit">
                        </form>
                </div>
        </div>
    </div>
    <?php include"partials/footer.php" ?>
          <!-- Bootstrap Javascript  -->
<script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script>

if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }


</script>
</body>
</html>