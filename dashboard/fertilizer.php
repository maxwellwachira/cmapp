<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

$page_name = 'Fertilizer';

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

	<title>CMAPP | Fertilizer</title>
	<!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../vendor/animate/animate.css" />
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
             <li><a href="#dropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-leaf"></i>Diseases </a>
              <ul id="dropdownDropdown" class="collapse list-unstyled ">
                <li><a href="common_diseases.php">Common Diseases</a></li>
                <li><a href="disease_management.php">Preventive / Curative measures</a></li>
                <li hidden="true"><a href="#">Chemical Stores</a></li>
              </ul>
            </li>
            <li class="active"><a href="fertilizer.php"> <i class="fa fa-flask"></i>Fertilizer</a></li>
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
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
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
      <div class="container" id = "toggle-info">
      	<div class="row">
	  		<div class="col-md-2">
	  		</div>
      		<div class="col-md-6">
      			<div id="op"></div>

				<form>
				  <div class="form-group">
				    <label for="Farm size">Farm size</label>
				    <input type="number" class="form-control" id="farm-size" placeholder="Enter the size of the Farm in Hectares">
				  </div>
				  <div class="form-group">
				    <label for="Tree age">Tree Age (years)</label>
				    <select class="form-control" id = "age">
				      <option value="1">1</option>
				      <option value="2">2</option>
				      <option value="3">3</option>
				      <option value="4">Over 3 years</option> 
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="nutrients">MacroNutrient</label>
				    <select class="form-control" id = "nutrients">
				      <option value="1">Nitrogen (N)</option>
				      <option value="2">Phosphorous (P<sub>2</sub>O<sub>5</sub>)</option>
				      <option value="3">Potassium (K)</option>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary mb-2">Calculate</button>
				</form>
	</div>
</div>


       
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

<script type="text/javascript">

	
	$('form').submit(function(event){
		event.preventDefault();
		var farm_size = $("#farm-size").val();
		var age = $("#age").val();
		var nutrients = $("#nutrients").val();
    

		if(!farm_size){
			$('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Enter the size of your Farm in Hectares</div>');
		}else{
			$('#op').html('');
      var fert_data = {
              farm_size:farm_size,
              age:age,
              nutrients:nutrients
      };
      var json_fert_data = JSON.stringify(fert_data);
      console.log(json_fert_data);  

			$.ajax({  
		        url:"api/fertilizer/fertilizer.php",  
		        method:"POST", 
		        data:json_fert_data,
            dataType:'json',
            contentType:'application/json; charset=utf-8',   
  			    success:function(data)  
  			    {  
  			          console.log(data);
                  var result = JSON.parse(JSON.stringify(data));
                  var fert_html = `
                          <div class = "container">
                            <div class = "row">
                              <div class = "col-md-1"></div>
                              <div class = "col-md-10">
                                <table class="table table-stripped animated zoomIn" id = "example">
                                  <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">Fertilizer</th>
                                        <th scope="col">Nutrients Demand (per year)</th>
                                        <th scope="col">Recommended Fertilizer Amount (per year)</th>
                                        <th scope="col">Total cost</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>`+result.nutrient+`</td>
                                        <td>`+result.amount+` Kg</td>
                                        <td>`+result.recommended_fert+`</td>
                                        <td>`+result.cost+` KSh.</td>
                                      </tr>
                                    </tbody>
                                </table>
                                <button id = "back" class = "btn btn-primary align-items-center">Back to Calculate</button>
                              </div>
                            </div>
                          </div>
                        `;
  			          $('#toggle-info').html(fert_html);
                  $('#back').click(function(){
                    location.reload();

                  }); 
  			    },
  			    error: function (jqXhr, textStatus, errorThrown) {
  			        console.log(jqXhr + textStatus + errorThrown);
  			    }
			});
		}

	});
  

</script>