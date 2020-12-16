<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

$page_name = 'Home';

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

       
    <title>CMAPP | Employees</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />
    <!--Data table -->
    <link rel="stylesheet" href="../vendor/datatables/jquery.dataTables.min.css">
     <!-- jQuery Circle-->
    <link rel="stylesheet" href="../assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../assets/css/fontastic.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../assets/css/style.default.css" id="theme-stylesheet">
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
    <script type="text/javascript" src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../vendor/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../vendor/datatables/buttons.flash.min.js"></script>
    <script type="text/javascript" src="../vendor/datatables/jszip.min.js"></script>
    <script type="text/javascript" src="../vendor/datatables/pdfmake.min.js"></script>
    <script type="text/javascript" src="../vendor/datatables/vfs_fonts.js"></script>
    <script type="text/javascript" src="../vendor/datatables/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../vendor/datatables/buttons.print.min.js"></script>

    <script src="../assets/js/charts-home.js"></script>
    <!-- Main File-->
    <script src="../assets/js/front.js"></script>
    <script src="api/employees/script.js"></script>  
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
            <li><a href="index.php" > <i class="icon-home"></i>Home</a></li>
            <li class="active"><a href="employee.php" > <i class="icon-user"></i>Employees</a></li>     
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
      <hr>      <!-- Header Section-->
    <div class="container-fluid">
     <main>
        
        <!-- put rows here -->
      <div class="row  " id="search_container" style="display: none;">
        <div class="input-group mb-3" style="box-shadow: 0px 0px 8px #888888;margin:5px; ">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
          </div>
          <input id="search" type="text" class="form-control" placeholder="search............." aria-label="search" aria-describedby="basic-addon1">
        </div>
      </div>

    <!-- op -->
    <div id="op"></div> 

    <!-- button s -->
    <div class="row d-flex justify-content-center">
      <div class="col-sm-6 col-md-3 col-lg-3">
        <button class="btn btn-outline-primary btn-sm" id="add_btn" style="box-shadow: 0px 0px 8px #888888;"><i class="fa fa-plus"></i> </button>
      </div>
      <br><br>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <button class="btn btn-outline-primary btn-sm" id="reports_btn" style="box-shadow: 0px 0px 8px #888888;"><i class="fa fa-bar-chart"></i> </button>
      </div>
      <br><br>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <button class="btn btn-outline-primary btn-sm" id="data_view_btn" style="box-shadow: 0px 0px 8px #888888;"><i class="fa fa-table"></i> Table view</button>
        <div id="data_view_ip" style="display:none ;">card</div>
      </div> 
      <br><br>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <button class="btn btn-outline-primary btn-sm" id="search_btn" style="box-shadow: 0px 0px 8px #888888;"><i class="fa fa-search"></i> </button>
      </div>
      <script type="text/javascript">
        $( document ).ready(function() {
            $('#search_btn').click(function(){
              $("#search_container").slideToggle("fast");
              return false;
            });
        });
      </script>
      
    </div>
    <hr>
    <div class="row" id="data_container"></div>
        <!-- Modal --> 
      <!-- add modal -->
      <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="add_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="add_modalLabel">
                <span class="fa-stack fa-lg">
                   <i class="fa fa-square-o fa-stack-2x"></i>
                   <i class="fa fa-plus fa-stack-1x"></i>
                 </span>
                  New Farm Employee
            </h5>
              <button id="close_add_modal" type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times"></i></span>
              </button>
            </div>
            <div class="modal-body">
              <div class="add_op"></div>
              
              <!-- serial no -->
              <!-- <i class="fa fa-user"></i> --> Full Name
              <div class="input-group mb-3">
                <input id="add_user_name" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="">
              </div>

              <!-- Name -->
              <!-- <i class="fa fa-user"></i> -->  Mobile Number
              <div class="input-group mb-3">
                <input id="add_phone_number" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="">
              </div>
                      Email
               <div class="input-group mb-3">
                <input id="add_email" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="">
              </div>

              <!-- <i class="fa fa-tags"></i> --> Work Group
              <div class="input-group mb-3">
                <select class="custom-select" id="add_work_group">
                  <!-- <option selected></option> -->
                  <option selected value="0"></option>
                  <option  value="1"> 1</option>
                  <option  value="2"> 2</option>
                  <option  value="3"> 3</option>
                  
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="add_submit" ><i class="fa fa-check"></i></button>
            </div>
          </div>
        </div>
      </div>

      <!-- edit modal -->
      <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="add_modalLabel">
                <span class="fa-stack fa-lg">
                   <i class="fa fa-square-o fa-stack-2x"></i>
                   <i class="fa fa-pencil fa-stack-1x"></i>
                 </span>
                  Edit Farm Employee Details
            </h5>
              <button id="close_add_modal" type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times"></i></span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <!-- <div id="edit_op"></div> -->
              </div>

              <!-- id -->
              <input type="" name="" id="edit_id" style="display: none;">
              <input type="" name="" id="edit_edited" style="display: none;">
              

              <!-- serial no -->
               Full Name 
              <div class="input-group mb-3">
                <input id="edit_user_name" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="">
              </div>

              <!-- name -->
              Mobile Number
              <div class="input-group mb-3">
                <input id="edit_phone_number" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="">
              </div>

                Email 
              <div class="input-group mb-3">
                <input id="edit_email" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="">
              </div>

              <!-- <i class="fa fa-tags"></i> --> Work Group
              <div class="input-group mb-3">
                <select class="custom-select" id="edit_work_group">
                  <!-- <option selected></option> -->
                  <option selected value="0"></option>
                  <option  value="1">1</option>
                  <option  value="2">2</option>
                  <option  value="3">3</option>
                  
                </select>
              </div>              
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="button" class="btn btn-success" id="edit_submit" ><i class="fa fa-check"></i></button>
              <div class="edit_op"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- reports modal -->
      <div class="modal fade" id="reports_modal" tabindex="-1" role="dialog" aria-labelledby="reports_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="reports_modalLabel">
                <span class="fa-stack fa-lg">
                   <i class="fa fa-square-o fa-stack-2x"></i>
                   <i class="fa fa-bar-chart fa-stack-1x"></i>
                 </span>
                  Reports and Downloads
            </h5>
              <button id="" type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times"></i></span>
              </button>
            </div>
            <div class="modal-body">
          <?php
          
            $numbering = 0; 
            $data_table = '
              <table class="table table-stripped table-sm" style="box-shadow: 0px 0px 8px #888888;background-color:#fff;margin:10px;">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col"></th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Work Group</th>
                    </tr>
                  </thead>
                  <tbody>';  

             $query = "SELECT * FROM employees where deleted=0 and manager_id= '".$_SESSION['id']."' order by id asc "; 
             $search_animation = ""; 

            if (!$result = mysqli_query($con, $query)) { exit(mysqli_error($con));}      

              // if query results contains rows then featch those rows 
              if(mysqli_num_rows($result) > 0){  
              while($row = mysqli_fetch_assoc($result)){

              $numbering += 1;
              

              $user_type = 1;

                  // type session management 
                    if ($user_type == 1)  {
                      
                      $user_type_string = '<span class="badge badge-warning">Admin</span>';
                    } else if ($user_type == 2)  {
                      $admin_actions = '';
                      $user_type_string = '<span class="badge badge-info">Trainer</span>';
                    } else if ($user_type == 3)  {
                      $admin_actions = '';
                      $user_type_string = '<span class="badge badge-success">Student</span>';
                    } else {
                      $user_type_string = '<span class="badge badge-danger"><i class="fa fa-warning"></i> Unidentified</span>';
                    }


              

              $data_table .= '
                <tr>
                      <th scope="row">'.$numbering.'</th>
                      <th>
                        
                      </th>
                      <td>'.$row["username"].' </td>
                      <td>'.$row["email"].'</td>
                      <td>'.$row["phone"].'</td>
                      <td>'.$row["workgroup"].'</td>
                    </tr> 
              ';

              }

              } else {
            $data_table = '<div class="alert alert-primary animated bounce" role="alert">No data in database</div>';

            }
            $data_table .= '</tbody></table>';

            
            echo  $data_table;
          ?>


              

            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="button" class="btn btn-success" id="edit_submit" ><i class="fa fa-check"></i></button>
              <div class="edit_op"></div>
            </div>
          </div>
        </div>
      </div>
    

    </main>
  </div>
  </div>

  </body>
</html>
