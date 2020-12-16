<?php
// Initialize the session
session_start();

$page_name = 'Login';

include 'access_log.php';
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard/index.php");
    exit;
}
 
// Include config file
require_once "db.php";

// instantiate database and user_class objects
$database = new Database();
$link = $database->getConnection_mysqli();

 
// Define variables and initialize with empty values
$password =  $email = "";
$password_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    // Check if email is empty
    if(empty(trim($_POST["email"]))){

        $email_err = '<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>  Please enter your email</div>';

    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = '<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>  Please type your password</div>';

    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if user exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: ../dashboard/index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = '<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>  Wrong Password!</div>';
                            
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                   
                    $email_err = '<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>  No account found with that email</div>';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>


    <title>CMAPP | Login</title>
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
        .field-icon {
          float: right;
          margin-left: -25px;
          margin-top: -25px;
          position: relative;
          z-index: 2;
        }
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

                 <form action="#" method="post">
                    <div class="text-center">
                        <a class="btn btn-success" href="../index.php" align="center">
                        <i class="fa fa-home"></i> 
                    </a>
                    </div>
                    
                    <div class="form-group ">
                        <label>Email</label>
                        <input type="email" name="email"  class="form-control" id = "email" value="<?php echo $email; ?>" style="background:#B2FFAB;">
                        <span class="help-block"><?php echo $email_err; ?></span>
                    </div>    
                    <div class="form-group ">
                        <label>Password</label>
                        <input type="password" name="password" id = "pwd" class="form-control" style="background:#B2FFAB;">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group text-center">
                        <a type="submit" id="login_submit"  href="forgot_password.php"> Forgot password?</a> 
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" id="login_submit" class="btn btn-success" ><i class='fa fa-check'></i> Login</button>
                    </div>
                    <div class="form-group text-center" >
                        <a id="" class="btn btn-outline-primary" href="../signup.php"> Don't have an account? Click here to register</a>
                    </div>
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
    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $("#pwd").attr("type");
      if (input == "password") {
        $("#pwd").attr("type", "text");
      } else {
        $("#pwd").attr("type", "password");
      }
});
</script>


