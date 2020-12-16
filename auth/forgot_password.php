<?php
// Initialize the session
session_start();

$page_name = 'Forgot password';

include 'access_log.php';
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard/index.php");
    exit;
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
                    <br>
                 <form action="#" method="post">
                    <div class="text-center">
                        <a class="btn btn-success" href="../index.php" align="center">
                        <i class="fa fa-home"></i> 
                    </a>
                    </div>
                    <div class="form-group" id="op">  
                    </div> 
                    
                    <div class="form-group ">
                        <label>Email</label>
                        <input type="email" name="email"  class="form-control" id = "email" style="background:#B2FFAB;">
                        
                    </div>    

                    <div class="form-group text-center">
                        <button  id="submit" class="btn btn-success" ><i class='fa fa-sign-in'></i> Get new password</button>
                    </div>
                    <div class="form-group text-center" >
                        <a id="" class="btn btn-outline-primary" href="../signup.php"> Don't have an account yet? Click here to register</a>
                    </div>
                    <br>
                </form> 
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
        // alert("running"); 
        $('#submit').click(function(){
            var email = $('#email').val();
            if (!email || (email=="")) {
                $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Please enter your email</div>');
            } else {
                // console.log(email);
                $.ajax({  
                    url:"forgot_password_backend.php",  
                    method:"post",  
                    data:{email:email},  
                    dataType:"text",  
                    success:function(data)  
                    {   
                        console.log(data);
                        var res = JSON.parse(data); 
                        if (res.status=="warning") {
                            $('#op').html('<div class="alert alert-warning animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> ' + res.message + '</div>');
                        } else if (res.status=="success") {
                            $('#op').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> ' + res.message + '</div>');
                        }
                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        // console.log(data);
                        console.log("Err : " + jqXhr + textStatus + errorThrown);
                    } 
                });  
            }
            
            return false;
        });
    });
</script>