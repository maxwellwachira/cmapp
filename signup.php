<?php

session_start();
$page_name = 'Sign up';

include 'auth/access_log.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>


    <title>CMAPP | sign Up</title>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <meta name="keywords" content="">
    <meta name="description" content="cmapp signup page">
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
    <!--Animate-->
    <link rel="stylesheet" href="vendor/animate/animate.css" />
    
        
    <style type="text/css">
        #form_div {
          border: 1px solid;
          padding: 10px;
          box-shadow: 5px 10px #888888;
        }
        .form-control:focus {
            border-color: #000;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(0, 0, 0, 0.5);
        }
        

    </style>
</head>
<body id="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98" style="background-color: #efeef2;">

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
                        <li><a class="nav-link" href="index.php">Home</a></li>
                        <li><a class="nav-link" href="about.php">About</a></li>
						<li><a class="nav-link active" href="auth/login.php">Login</a></li>
                        <li><a class="nav-link" href="#">Blog</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <!-- End header -->
        <!-- section -->
    <section style="padding-top: 50px;"></section>
    <!-- end section -->

    <div class="container">
        <div class = "row animated bounce" >
            <div class="col-md-2"></div>
            <div class="col-md-8 layout_padding_2 card" id="form_div">
                <div id="op"></div>
                <form action="#" method="post">
                    <div class="text-center">
                        <a class="btn btn-success" href="index.php" align="center">
                        <i class="fa fa-home"></i> 
                    </a>
                </div>
                    <div class="form-group ">
                        <label>Username</label>
                        <input type="text" id="name" class="form-control" style="background:#B2FFAB;">
                        
                    </div>    
                    <div class="form-group ">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control"  style="background:#B2FFAB;">
                        
                    </div> 
                    <div class="form-group " hidden="true">
                        <label>Account Type</label>
                        <br>
                        <select id="type" style="background:#B2FFAB;" class="form-control">
                            <option value="0">Select what describes you best</option>
                            <option value="1">1. Farm employee</option>
                            <option value="2">2. Farm manager</option>
                        </select>
                        
                    </div>   

                    <div class="form-group ">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control"  style="background:#B2FFAB;">
                       
                    </div>
                    <div class="form-group ">
                        <label>Confirm Password</label>
                        <input type="password" id="confirm_password" class="form-control"  style="background:#B2FFAB;">
                        
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" id="login" class="btn btn-success" ><i class='fa fa-check'></i> Sign Up</button>
                    </div>
                    <div class="form-group text-center">

                        <p>Already have an account? <b><a href="auth/login.php" style="color: green">Login here</a></b></p>
                    </div>
                    
                </form>
            </div>
        </div>    
    </div>

    <section style="padding-bottom: 50px;"></section>

    
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

    <script src="auth/signup.js"></script>
    
</body>
</html>