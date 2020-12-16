<?php

session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

$page_name = 'Disease management';

include '../auth/access_log.php';
// include Database connection file 
$con = $database->getConnection_mysqli();
        
?>
<!DOCTYPE html>
<html>
  <head> 

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
       
    <title>CMAPP | Disease Management</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />
     <!-- jQuery Circle-->
    <link rel="stylesheet" href="../assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../assets/css/fontastic.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../assets/css/style.default.css" id="theme-stylesheet"> 
 
  </head>
  <body>

       <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="../images/web/logo.PNG">
          </div>
          <hr>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.php" class="brand-small text-center"> <strong><i style="color: #1c4f1b;">CMAPP</i></strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li ><a href="index.php" > <i class="icon-home"></i>Home</a></li>
            <li ><a href="employee.php" > <i class="icon-user"></i>Employees</a></li>
            <li><a href="tasks.php"> <i class="fa fa-wrench"></i>Tasks</a></li>
             <li class="active"><a href="#dropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-leaf"></i>Diseases </a>
              <ul id="dropdownDropdown" class="collapse list-unstyled ">
                <li><a href="common_diseases.php">Common Diseases</a></li>
                <li class="active"><a href="disease_management.php">Preventive / Curative measures</a></li>
                <li hidden="true"><a href="#">Chemical Stores</a></li>
              </ul>
            </li>
            <li ><a href="fertilizer.php"> <i class="fa fa-flask"></i>Fertilizer</a></li>
            <li ><a href="chemical_stores.php"> <i class="fa fa-map-marker"></i>Chemical Stores</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="page">
     
       <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.php" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">CMAPP DASHBOARD <i class="fa fa-tachometer" style="padding-left: 5px;"></i></strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
        
                <!-- Log out-->
                <li class="nav-item"><a href="../auth/logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
                <li class="nav-item"><a href="../auth/reset_pwd.php" class="nav-link logout">Reset password <i class="fa fa-key" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <hr>      <!-- Header Section-->
      <section class="dashboard-header section-padding">
        <div class="container-fluid">
          <div class="row d-flex align-items-md-stretch">
           
            <!-- Pie Chart-->
             <div class="col-md-12">
             <h2>1. Management of Coffee Berry Disease (Colletotrichum kahawae)</h2>
             <br>
             <h3>Symptoms</h3>
             <ul>
              <li><b>Cultural control: </b> Proper and timely pruning, handling and de-suckering, and regular
              change of cycle. This reduces the initial disease inoculum. </li>
              <li><b>Chemical control:</b>  Correct and timely use of recommended fungicides. It is advisable
              to complete the recommended CBD control program for it to be effective and to avoid
              development of resistance by the pathogen. Farmers should start spraying before the rains
              and continue until the rains and the cold spells are over </li>
              <li><b>Resistant varieties:</b> DNew planting of disease resistant varieties or conversion of
              susceptible varieties to resistant ones through top working </li>  
             </ul>
             
             <section style="padding-top: 30px;"></section>

             <h2>2. Management of Coffee Leaf Rust (Hemileia vastatrix) </h2>
             <br>
             <ul>
              <li><b>Cultural control:</b> Proper and timely pruning and regular change of cycle </li>
              <li><b>Chemical control:</b> This entails the use of recommended Copper-based fungicides.
                Timing is critical for the control of leaf rust and the sprays should be applied before the
                commencement and during the early period of the rainy season. For effective
                management:
                <ul>
                  <li>Start the 1st round of sprays just before the short rains and repeat 3 weeks later</li>
                  <li>Start the 2nd round of sprays before the onset of long rains and do 2 more at 3 weeks interval </li>
                  <li>In case the infection is severe (20% of leaves have rust), it is necessary to use a
                    systemic fungicide such as Alto or Bayleton. Do not spray more than 2 times a
                    year as it affects production of plant hormones leading to hormonal imbalance
                    such as the balance between floral and vegetal inducing hormones. This may affect
                    flowering and thus production </li>
                  <li>Adhere to the spray programme. Improper use of fungicides may lead to
                    development of resistance by the pathogen </li>
                </ul>
                <li><b>Resistant varieties</b> Planting of disease resistant varieties or conversion of susceptible varieties to resistant ones through top-working</li>
                 </li>
             </ul>

             <section style="padding-top: 30px;"></section>

             <h2>3. Management of Fusarium Bark Disease  </h2>
             <br>
             <ul>
              <li><b>Cultural control:</b>
                <ul>
                  <li>Avoid deep planting</li>
                  <li>Keep soil pH at optimum (4.4-5.4)</li>
                  <li>Proper application of mulch (6” from the stump) to avoid Collar rot </li>
                  <li>Sterilising of pruning tools with methylated spirit</li>
                  <li>Eliminate wood boring insect pests e.g. yellow headed borer. This can be done
                      by maintaining soil potash at optimal level as per soil analysis recommendations</li>
                  <li>Uproot and burn all infected trees having die bark from Collar rot</li>
                </ul>
              </li>
              <li><b>Chemical control:</b> This entails the use of recommended Copper-based fungicides.
                Timing is critical for the control of leaf rust and the sprays should be applied before the
                commencement and during the early period of the rainy season. For effective
                management:
                <ul>
                  <li>In case of storey bark disease cut off and burn affected suckers or heads. Paint the
                    scars with a fungicidal paint (1 teaspoonful of Captan plus 150ml vegetable oil)</li>
                  <li>In disease prone areas, spray suckers raised for conversion fortnightly with Captan
                    at 40gm in 10 litres of water from emergence until wood bark matures to about
                    30 cm (1 foot) from the base </li>
                  <li>For scaly bark, no action need to be taken as long as no further signs of disease develop </li>
                </ul>
                 </li>
             </ul>
             
            </div>
          </div>
        </div>
      </section>
       
    </div>
     
    <!-- JQUERY -->
    <script src="../vendor/jquery/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>

    <script src="../assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>

    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <!-- Chart.JS -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="../assets/js/charts-home.js"></script>
    <!-- Main File-->
    <script src="../assets/js/front.js"></script>  
  </body>
</html>