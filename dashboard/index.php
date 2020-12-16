<?php

session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

$page_name = 'Dashboard';

include '../auth/access_log.php';
// include Database connection file 
$con = $database->getConnection_mysqli();
$query = "SELECT * FROM users WHERE deleted = 0 and id = '".$_SESSION['id']."' LIMIT 1";
$user_name = '';
$result = mysqli_query($con, $query);
if (!$result){
  $user_name = "Manager";
} else {
  $num_user = mysqli_num_rows($result);
  if ($num_user == 1) {
      $row = mysqli_fetch_assoc($result);
      $user_name = $row['username'];
  }
}

$sql = "SELECT * FROM tasks WHERE deleted = 0 and manager_id = '".$_SESSION['id']."'";
$result_1 = mysqli_query($con, $sql);
if (!$result_1){
  exit(mysqli_error($con));
} else {
  $num_task = mysqli_num_rows($result_1);
}

$sql_1 = "SELECT * FROM employees WHERE deleted = 0 and manager_id = '".$_SESSION['id']."'";
$result_2 = mysqli_query($con, $sql_1);
if (!$result_2){
  exit(mysqli_error($con));
} else {
  $num_employees = mysqli_num_rows($result_2);
}
        
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

       
    <title>CMAPP | Dashboard</title>
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
            <li class="active"><a href="index.php" > <i class="icon-home"></i>Home</a></li>
            <li ><a href="employee.php" > <i class="icon-user"></i>Employees</a></li>
            <li><a href="tasks.php"> <i class="fa fa-wrench"></i>Tasks</a></li>
             <li><a href="#dropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-leaf"></i>Diseases </a>
              <ul id="dropdownDropdown" class="collapse list-unstyled ">
                <li><a href="common_diseases.php">Common Diseases</a></li>
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
      <hr>
      <div class="container-fluid">
        <br>
        <h3> WELCOME <?php echo '<b>'. strtoupper($user_name) .'</b>' ?> </h3><br>
        <p>This is your personal dashboard. You can use this platform to determine the specific amount of fertilizer, add employees, assign tasks to employees and so many more options. Explore more options on the dashboard and have fun improving the management of your coffee plantation<br></p>
        <br><br>
        <h3 style="margin: 5px;">STATS</h3>
        <br>
        <div class="row">
        <div style="" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div  style="box-shadow: 0px 0px 8px #888888;margin:5px;">
            <div class="card" style="width: ;">
              <!--img src="..." class="card-img-top" alt="..."-->
              <div class="card-body">                
                <h5 class="card-title"><i class="fa fa-user"></i> Employee Stats</h5>                
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Total Employee(s): </b><?php echo $num_employees; ?> </li>
                <li class="list-group-item">Click <a href="employee.php">here</a> to manage your employees</li>
              </ul>
              </div>
            </div>
          </div>

          <div style="" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div  style="box-shadow: 0px 0px 8px #888888;margin:5px;">
            <div class="card" style="width: ;">
              <!--img src="..." class="card-img-top" alt="..."-->
              <div class="card-body">                
                <h5 class="card-title"><i class="fa fa-wrench"></i> Tasks Stats</h5>                
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Total Task(s): </b><?php echo $num_employees; ?> </li>
                <li class="list-group-item">Click <a href="tasks.php">here</a> to manage your tasks</li>
              </ul>
              </div>
            </div>
          </div>

       
    </div>
  </div>
     
    <!-- JQUERY -->
    <script src="../vendor/jquery/jquery.js"></script>
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
