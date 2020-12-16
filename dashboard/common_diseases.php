<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

$page_name = 'Common Diseases';

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
       
    <title>CMAPP | Common Diseases</title>
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
                <li class="active"><a href="common_diseases.php">Common Diseases</a></li>
                <li><a href="disease_management.php">Preventive / Curative measures</a></li>
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
             <h2>1. Coffee Berry Disease (Colletotrichum kahawae)</h2>
             <br>
             <h3>Symptoms</h3>
             <ul>
              <li><b>On flowers:</b> Dark brown blotches/streaks on the petals. Flowers may be destroyed but
                  loses from flower infection are generally not serious</li>
              <li><b>On green berries:</b> Small dark sunken patches/lesions which spread rapidly and may cover
                  the whole berry. Infected berries may be shed or remain on the trees in a black shrivelled
                  condition</li>
              <li><b>On ripe berries:</b> Dark sunken lesions with black dots spreading rapidly on the ripe berries
                (late Blight)</li>
              <li><b>On leaves:</b> Brown marginal spots. However, leaf infection is not common </li>
              <li>Severe infections may cause the die-back of twigs and branches</li>  
             </ul>
             <img src="../images/gallery/CBD.PNG" style="padding-left: 35px;">
             <section style="padding-top: 20px;"></section>
             <h3>Conditions favouring high disease incidences </h3>
             <ul>
               <li>Cool temperatures – 18-20 degree Celcius</li>
               <li>High humidity - encourages spores production </li>
               <li>Rainfall – rain droplets disperse the spores to the rest of the tree. After the dispersal, at
                  least 5 hours of wetness on the berries are required for the spores to germinate.
                  Rainfall occurring in the late afternoon is therefore likely to provide suitable conditions
                  for infection </li>
             </ul>

             <section style="padding-top: 30px;"></section>

             <h2>2. Coffee Leaf Rust (Hemileia vastatrix) </h2>
             <br>
             <h3>Symptoms</h3>
             <ul>
              <li>Pale yellow spots appear on the underside of the leaves at the onset of infection </li>
              <li>The spots later change to yellow/orange powdery masses</li>
              <li>Affected leaves fall off prematurely in case of severe infection. This condition may cause
                dieback if not controlled </li>
             </ul>
             <img src="../images/gallery/coffee_leaf_rust.PNG" style="padding-left: 35px;">
             <section style="padding-top: 20px;"></section>
             <h3>Conditions favouring high disease incidences </h3>
             <ul>
               <li>Warm and wet conditions </li>
               <li>Wind and or rain – disperses the spores</li>
               <li>After the dispersal of spores, at least 3 hours of wetness on the leaves are required for
                  them to germinate. Only germinating spores on the lower surface of a leaf can penetrate
                  and cause infection  </li>
             </ul>

             <section style="padding-top: 30px;"></section>

             <h2>3. Bacterial Blight of coffee (Pseudomonas syringae pv. garcae)  </h2>
             <br>
             <h3>Symptoms</h3>
             <ul>
              <li>On leaves: black soaked lesions. Leaves eventually dry out, roll inwards and turn brown but do not shed </li>
              <li>On twigs and shoot tips: die back syndrome as infection extends downwards from the terminal bud</li>
              <li>On flowers and pin head stage: If attacked, pin heads appear water soaked. Both the
                  flowers and pin heads shrivel, turn black and the entire crop may be lost  </li>
              <li>On internodes of young branches: Dying of branches above the area of infection. Infection
                  may start at the internodes of young succulent branches or green stems as a result of hail
                  damage or through wounds caused by sucking insects</li>
             </ul>
             <img src="../images/gallery/bacterial_blight.PNG" style="padding-left: 50px;">
             <section style="padding-top: 20px;"></section>
             <h3>Conditions favouring high disease incidences </h3>
             <ul>
               <li>Cool and wet weather </li>
               <li>Injuries as a result of hailstorms and insect attack</li>
             </ul>


             <section style="padding-top: 30px;"></section>

             <h2>4. Fusarium Bark Disease (Fusarium stilboides)   </h2>
             <br>
             <h3>Symptoms</h3>
             <ul>
              <li>Yellowing and wilting of leaves and eventual death of the tree </li>
              <li>For Storeys bark - suckers are attacked at the base forming lesions that girdle the stem forming a bottle neck at the base </li>
              <li>For Collar rot - a cankerous lesion develops causing a constriction at the base near the
                ground level   </li>
              <li>For Scaly bark – Rising up and flaking of the bark on mature stem especially at the point
                  where a primary has been cut off. On old trees, this may be difficult to recognize.
                  However, when seen on young wood or associated with cankerous regions around the
                  base of branches or suckers, it is most likely Fusarium. Unless cankerous areas develop
                  or dieback begins, affected stems and branches may survive</li>
             </ul>
             <img src="../images/gallery/fusarium.PNG" style="padding-left: 50px;">
             <section style="padding-top: 20px;"></section>
             <h3>Conditions favouring high disease incidences </h3>
             <ul>
               <li>Poor nutrient status of soil </li>
               <li>Weak trees as a result of poor establishment, drought or scorch </li>
               <li>Scars on trees due to pruning, careless slashing of weeds and herbicide damage on green suckers </li>
               <li>Excessive weed growth and mulching too close to the stem causing a warm moist micro
                  climate around the base </li>
               <li>Failure to destroy affected trees </li>
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