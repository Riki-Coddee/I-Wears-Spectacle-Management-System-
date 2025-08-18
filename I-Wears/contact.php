<?php
include "php/database.php";
$updatedAlert = false;
$updatedError = false;
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contactName = $_POST['contact-name'];
    $contactPhone = $_POST['contact-phone'];
    $contactEmail = $_POST['contact-email'];
    $contactSubject = $_POST['contact-subject'];
    $contactMsg = $_POST['contact-msg'];

    // Prepare the SQL statement using a prepared statement
    $sql = "INSERT INTO `contact` (`name`, `phone`, `email`, `subject`, `message`,`message_at`) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssss", $contactName, $contactPhone, $contactEmail, $contactSubject, $contactMsg);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $updatedAlert = "Thank you for your message! We'll get back to you as soon as possible";
        } else {
            $updatedError = "We're sorry, but there was an error submitting your message. Please try again later";
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
<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>I-Wears - Contact-Us</title>
<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="images/favicon.ico">

<!--	Fonts
	========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">
<!-- Boostrap css  -->
<link rel="stylesheet" href="Iwear_css/bootstrap.min.css">
<link rel="stylesheet" href="Iwear_css/bootstrap.min.css.map">
<!--	Css Link
	========================================================-->
<link rel="stylesheet" type="text/css" href="Iwear_css/iwear.css">
<link rel="stylesheet" type="text/css" href="Iwear_css/footer.css">
<link rel="stylesheet" type="text/css" href="Iwear_css/contact-us.css">


<!-- Font Awesome -->
<link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">

<link rel="icon" href="image/Black White Bold Business Logo.jpg" type="image/iwear-logo">


<!--	Title
	=========================================================-->
<title>Contact-Us</title>
</head>
<style>
 .proHeading {
            font-weight:bold;
            font-size:25px;
        }
        .margin-top{
            margin: 50px;
        text-align: center;
        }
</style>
<body>

<!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div>
--> 

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
       <div id="contact-wrapper">
                <div class="contactheader">
                    <div class="header-wrapper">
                    <img src="image/contactheader.jpeg" alt="">
                    </div>
                </div>
                <div class="contactContainer">
                    <div class="contact-box"> 
                        <div class="contact-left">
                            <h3>Send your request</h3>
                            <form method="post">
                                <div class="input-row">
                                    <div class="input-group">
                                        <label for="contact-name">Name</label>
                                        <input type="text" placeholder="Your name*...." name="contact-name" required>
                                        </div>
                                    <div class="input-group">
                                        <label for="contact-phone">Phone</label>
                                        <input type="text" placeholder="Your phone number*...." name="contact-phone" required>
                                        </div>
                                    <div class="input-group">
                                        <label for="contact-email">Email</label>
                                        <input type="text" placeholder="Your email...." name="contact-email">
                                        </div>
                                    <div class="input-group">
                                        <label for="contact-email">Subject</label>
                                        <input type="text" placeholder="Subject...." name="contact-subject">
                                        </div>
                                    <div class="input-group">
                                        <label for="contact-email">Message</label>
                                        <textarea  placeholder="Type Message....." name="contact-msg" required ></textarea>
                                        </div>
                                        
                                        <button type="submit">Send Message</button>
                                </div>
                            </form>
                        </div>
                        <div class="contact-right">
                                <h3>Reach Us</h3>
                                <div class="info">
                                    <div class="email">
                                        <h1><i class="fa-solid fa-envelope"></i>Email</h1>
                                        <p>Iwear_contact_services@gmail.com</p>
                                        <p>Iwear_contactAgents@gmail.com</p>
                                    </div>
                                    <div class="email">
                                        <h1><i class="fa-solid fa-phone"></i>Phone</h1>
                                        <p>+977 - 9800999092</p>
                                        <p>+977 - 9800999092</p>
                                        
                                    </div>
                                    <div class="email">
                                        <h1><i class="fa-solid fa-address-book"></i>Address</h1>
                                        <p>#212, Ground Floor, 7th cross Some layout, Some Road, Prime International College Nayabazar, Kathmandu</p>
                                        
                                    </div>
                                </div>
                               
                         </div>
                  </div> 
              </div>
		<iframe id="map-container" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28030.59725419858!2d85.32407914610785!3d27.71724536176852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19bf7c5b807b%3A0xe452557098d1a87c!2sKathmandu%2C%20Nepal!5e0!3m2!1sen!2sin!4v1644123456789!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		<!--	Map -->
        
        <!--	Footer   start-->
		<?php include("partials/footer.php");?>
		<!--	Footer   start-->
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>

<!-- Wrapper End --> 

<!--	Js Link
============================================================--> 

<!-- Bootstrap Javascript  -->
<script src="javascript/bootstrap-Js/bootstrap.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.min.js.map"></script>
<script src="javascript/bootstrap-Js/bootstrap.buddle.min.js"></script>
<script defer src="javascript/bootstrap-Js/bootstrap.buddle.min.js.map"></script>
<script>
    if(window.history.replaceState){
     window.history.replaceState(null, null, window.location.href);
    }

</script>
</body>
</html>