<?php

session_start();
$page_name = 'Home';

include 'auth/access_log.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>CMAPP</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <meta name="keywords" content="">
    <meta name="description" content="cmapp home page">
    <meta name="author" content="DSAIL-agriculture-team">

    <!-- Site Icons -->
    <!--<link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" /> -->

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="vendor/pogo-slider/css/pogo-slider.min.css" />
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
                        <li><a class="nav-link active" href="index.php">Home</a></li>
                        <li><a class="nav-link" href="about.php">About</a></li>
						<li><a class="nav-link" href="auth/login.php">Login</a></li>
                        <li><a class="nav-link" href="#">Blog</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <!-- End header -->
    <!-- Start Pogo slider -->
    <div class="ulockd-home-slider">
        <div class="container-fluid">
            <div class="row">
                <div class="pogoSlider" id="js-main-slider">
                    <div class="pogoSlider-slide" style="background-image:url(images/web/coffee1.jpg);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slide_text">
                                       <h3><span span class="theme_color"><strong>Coffee Management Application (CMapp)</strong></span></h3> 
                                       <h4 style="font-weight: 900"><strong>For improved yield, quality, and best farming practices for coffee farmers</strong></h4>
                                        <br>
                                        <div class="full center">
                                            <a class="contact_bt" href="about.php">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pogoSlider-slide" style="background-image:url(images/web/coffee1.jpg);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slide_text">
                                        <h3><span span class="theme_color"><strong>Coffee Management Application (CMapp)</strong></span></h3> 
                                       <h4 style="font-weight: 900"><strong>For improved yield, quality, and best farming practices for coffee farmers</strong></h4>
                                        <br>
                                        <div class="full center">
                                            <a class="contact_bt" href="about.php">Learn more</a>
                                        </div>
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .pogoSlider -->
            </div>
        </div>
    </div>
    
	<!-- end section -->
	<!-- section -->
    <div class="section margin-top_50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 layout_padding_2">
                    <div class="full">
                        <div class="heading_main text_align_left">
						   <h2 style="color:#1C4F1B;">CMapp for coffee farmers</h2>
                        </div>
						<div class="full">
						  <p>
						      CMapp, a coffee plantation management software, helps to manage daily coffee farming tasks to ensure best coffee farming practices are being used at all times. With the help of CMapp, tasks such as work allocation to farm employees can be automated hence saving time. The total amount of a specific fertilizer can be determined using the application thereby enabling the farmer to plan effectively.

						  </p>
						</div>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="full">
                        <p style="padding-top: 22% ">
                        Coffee plantation managers can receive immediate benefits from CMapp feature rich software which is designed for Coffee growers and Coffee plantations. With CMapp, you will increase your coffee farm's efficiency, reduce waste,  manage an unlimited number of coffee farms, manage your farm employees and also get a forum to ask questions to other coffee farmers as well as exchange coffee farming ideas with other farmers.  Thus the software solution is an essential tool for professional coffee plantation management.  
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- end section -->
	
    <section style="padding-top: 5%"></section>
      <!-- start Footer -->

    <div class="footer_bottom" style="background: #1C4F1B; ">
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
    <!-- Pogo Slider JS -->
    <script src="vendor/pogo-slider/js/jquery.pogo-slider.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/custom.js"></script>
    <!-- Slider JS -->
    <script src="assets/js/slider-index.js"></script>
</body>

</html>