<?php

session_start();
$page_name = 'About';

include 'auth/access_log.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>

    <title>CMAPP | About</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <meta name="keywords" content="">
    <meta name="description" content="cmapp about page">
    <meta name="author" content="DSAIL-agriculture-team">

    <!-- Site Icons -->
    <!--<link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" /> -->

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css" />
    
</head>

<body id="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

   	    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="images/web/loader.gif" alt="loading........" />
        </div>
    </div>
    <!-- end loader -->
    <!-- END LOADER -->    

<!-- Start header -->
    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"> <img src = "images/web/logo.PNG"> </a>
                <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link"  href="index.php">Home</a></li>
                        <li><a class="nav-link active" href="about.php">About</a></li>
						<li><a class="nav-link" href="auth/login.php">Login</a></li>
                        <li><a class="nav-link" href="#">Blog</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <!-- End header -->	<!-- section -->
	
	<section class="inner_banner" style="background: #1C4F1B;">
	  <div class="container">
	      <div class="row">
		      <div class="col-12">
			     <div class="full">
				     <h3>About CMAPP</h3>
				 </div>
			  </div>
		  </div>
	  </div>
	</section>
	
	<!-- end section -->
   
	<!-- section -->
    <div class="section margin-top_50">
        <div class="container">
            <div class="row">
                <div class="col-md-12 layout_padding_2">
						<div class="full">
							<!--<img style = "padding-bottom: 10%;" src="images/web/coffee2.jpg">-->
						  <p>
                                CMApp is an application buit for coffee farmers so that they can easily manage their farms and plan effectively for maximum coffee production. The Web version is ment for farm managers where as the mobile app is ment for coffee farm employees. The farm manager can also use the mobile app.                  
                          </p>
                          <p>
                              To use CMApp, the farm manager will have to <a href="signup.php">create </a> an account first.
                              After successfully creating the account, the manager will <a href="auth/login.php">log in</a> and get a whole lot of amazing features to use on the dashboard 
                          </p>
                          <p>
                              One of the amazing feature is the capacity to add farm employees using the personalized dashboard. The added farm employee will receive an email with all the log in credentials as well as the name of the farm manager who added him/her. In the future, we will also notify farm employees with SMS since they are relatively more reliable as compared to emails
                          </p>
                          <p>
                              Another amazing feature is the ability to assign tasks to farm employees. This will effectively reduce the morning meetings where the farm manager meet with the employees to delegate tasks.<br> Farm employees will receive notifications if they have been assigned to perform a particular task
                          </p>
                          <p>
                              The farm manager can also determine the amount of fertilizer required for effective planning. The app will also determine the approximate cost to be incurred. The price is approximate since prices keep on flactuating. In addition to this, the app will aslo show the location of  <b>Chemical Stores</b> where you can purchase the fertilizer and many other agro-chemicals
                          </p>
                          <p>
                              CMApp has some agronomics literature when it comes to common coffee diseases, their cause and symptoms. It doesn't leave it there, it continues to explain to farmers how they can effectively control these common diseases. 
                          </p>
                          <p>Don't be left out!! Join the CMApp family and Have an easy time planning and managing your coffee plantation... <br>For any queries you can reach out to us <a class="btn btn-success" href="contact.php">here</a> </p>
                        <br><br><br>

						</div>
                    </div>
                  </div>                       
            </div>
         </div>              
    </div>
	<!-- end section -->
	<!-- section --> 
	<!-- end section -->

    <div class="footer_bottom" style="background: #1C4F1B;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="crp">© CMapp</p>
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="scroll-to-top"  style="background: #000000;" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>
    <!-- JQUERY -->
    <script src="vendor/jquery/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="vendor/bootstrap/js/bootstrap.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/custom.js"></script>

</body>

</html>