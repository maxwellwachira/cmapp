<?php
// Initialize the session
session_start();

$page_name = 'Reset Password';

include 'access_log.php';
 
if (isset($_GET['rst'])) {

        // Include config file
        require_once "db.php";

        // instantiate database and user_class objects
        $database = new Database();
        $con = $database->getConnection_mysqli();
        
        $rst_serial = htmlspecialchars(mysqli_escape_string($con, $_GET['rst']));

        $op = '';
        $form = '';

        //structure query
        $sql  = "SELECT *"; 
        $sql .= " FROM pwd_rst where serial = '$rst_serial' limit 1";
        // $sql .= " ORDER BY column DESC";

        //run query
        $result = mysqli_query($con, $sql);

        if ($result) {
            $response_num_rows = mysqli_num_rows($result);
            if ($response_num_rows == 0) {
                $op = '<div class="text-center">
                        <a class="btn btn-success" href="../index.php" align="center">
                        <i class="fa fa-home"></i> 
                    </a>
                    </div><br><br><div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> Sorry but your reset link seems to have expired</div><br><br><br><br>';
            } else {
                $row = mysqli_fetch_array($result);
                if ($row["status"] == '1') {
                    $op = '<div class="text-center">
                        <a class="btn btn-success" href="../index.php" align="center">
                        <i class="fa fa-home"></i> 
                    </a>
                    </div><br><br><div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> Sorry your reset link seems to have expired</div><br><br><br><br>';
                } else {
                    // continue
                    $form = '
                    <div id = "pwd_form">
                    <input style="display:none;" type=""  class="form-control" id="serial" value="'.$rst_serial.'">
                    <div class="text-center">
                        <a class="btn btn-success" href="../index.php" align="center">
                        <i class="fa fa-home"></i> 
                    </a>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-password"></i> New Password</label>
                        <input type="password"  class="form-control" id="new_pwd">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label><i class="fa fa-password"></i> Confirm Password</label>
                        <input type="password"  class="form-control" id="new_pwd_rpt">
                        <span class="help-block"></span>
                    </div>    
                    
                    <div class="form-group text-center">
                        <button type="submit" id="submit" class="btn btn-success" ><i class="fa fa-check"></i> Submit</button>
                    </div>
                    </div>';

                }

            }
        }else {
            $op = '<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i>ERROR : Contact System Admin.</div>';
        }
        

    } else {
        header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>


    <title>CMAPP | Forgot Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <meta name="keywords" content="">
    <meta name="description" content="cmapp login page">
    <meta name="author" content="DSAIL-agriculture-team">

    <!-- Site Icons -->
    <!--<link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" /> -->

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    
    <style type="text/css">
        .form-control:focus {
            border-color: #000;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(0, 0, 0, 0.5);
        }
        #form_div {
          border: 1px solid;
          padding: 10px;
          box-shadow: 5px 10px #888888;
        }
    </style>
    

</head>
<body id="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98" style="background-color: #efeef2;">

        <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="../images/web/loader.gif" alt="loading........" />
        </div>
    </div>
    <!-- end loader -->
    <!-- END LOADER -->    

<!-- Start header -->
    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php"> <img src = "../images/web/logo.PNG"> </a>
                <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link" href="../index.php">Home</a></li>
                        <li><a class="nav-link" href="../about.php">About</a></li>
						<li><a class="nav-link active" href="login.php">Login</a></li>
                        <li><a class="nav-link" href="#">Blog</a></li>
						<li><a class="nav-link" href="../contact.php">Contact us</a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <!-- End header -->
        <!-- section -->
    <section style="padding-top: 50px;"></section>
    <!-- end section -->


        <br><br>
        <div class="container">
        <div class = "row animated bounce" >
            <div class="col-lg-3 col-md-3 col-sm-12">

                </div>

            <div class="col-lg-6 col-md-6 col-sm-12 card" style="padding-left: 20px;" id="form_div">
                <div class="form-group" id="op">
                        <?php echo $op; ?>
                    </div> 

                    <?php echo $form; ?>

            </div>
        </div>
        
    </div>    

     <section style="padding-bottom: 150px;"></section>

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
    <script src="../vendor/jquery/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <!-- Custom JS -->
    <script src="../assets/js/custom.js"></script>

</body>
</html>
<script type="text/javascript">
        $( document ).ready(function() {
            $('#submit').click(function(){
                var serial = $('#serial').val();
                var user_id = $('#user_id').val();
                var new_pwd = $('#new_pwd').val();
                var new_pwd_rpt = $('#new_pwd_rpt').val();

                if(!new_pwd || !new_pwd_rpt){
                    $('#op').html('<br><div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>Fill out all fields</div>');
                }else{

                    // console.log(serial);
                    $.ajax({  
                        url:"reset_backend.php",  
                        method:"post",  
                        data:{serial:serial, new_pwd:new_pwd, new_pwd_rpt:new_pwd_rpt},  
                        dataType:"text",  
                        success:function(data)  
                        {  
                                var result = JSON.parse(data);
                                if (result.status == 'success') {
                                    
                                    $('#op').html('<br><br><div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check"></i> Password Reset was Successfull. Click here to log into your account <a type="button" href="login.php" class="btn btn-success">Log in</a></div><br><br><br>');
                                    $("#pwd_form").html('');

                                } else if (result.status == 'warning') {
                                    $('#op').html('<br><br><div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>' + result.message + '</div><br><br><br>');
                                    
                                }  
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            // console.log(data);
                            console.log(jqXhr + textStatus + errorThrown);
                        } 
                    });  
                }
                return false;
            });
        });
    </script> 