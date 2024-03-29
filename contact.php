<?php

session_start();
$page_name = 'Contact Us';

include 'auth/access_log.php';
?>



<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <title>CMAPP | Contact</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <meta name="keywords" content="">
    <meta name="description" content="cmapp contact page">
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
    

</head>

<body id="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

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
						<li><a class="nav-link" href="auth/login.php">Login</a></li>
                        <li><a class="nav-link" href="#">Blog</a></li>
						<li><a class="nav-link active" href="contact.php">Contact us</a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <!-- End header -->  

	<!-- section -->
	
	<section class="inner_banner" style="background: #1C4F1B;">
	  <div class="container">
	      <div class="row">
		      <div class="col-12">
			     <div class="full">
				     <h3>Contact us</h3>
				 </div>
			  </div>
		  </div>
	  </div>
	</section>
	
	<!-- end section -->
   
	<!-- section -->
    <div class="section layout_padding contact_section" style="background:#f6f6f6;">
        <div class="container">
               <div class="row">
                 <div class="col-lg-8 col-md-8 col-sm-12">
				    <div class="full float-right_img">
                        <img src="images/web/contact.jpg" alt="#">
                    </div>
                 </div>
				 <div class="col-lg-4 col-md-4 col-sm-12">
				    <div class="contact_form">
					    <form method="post">
						   <fieldset>
                               <div id = "err_msg"></div>
						       <div class="full field">
							      <input type="text" placeholder="Your Name" id ="name" style="background:#B2FFAB;" />
							   </div>
							   <div class="full field">
							      <input type="email" placeholder="Email Address" id ="email" style="background:#B2FFAB;" />
							   </div>
							   <div class="full field">
							      <input type="phn" placeholder="Phone Number" id ="phonenumber" style="background:#B2FFAB;" />
							   </div>
							   <div class="full field">
							      <input type="text" placeholder="Subject of the Message" id ="subject" style="background:#B2FFAB;" />
							   </div>
							   <div class="full field">
							      <textarea placeholder="Message" id  = "message" style="background:#B2FFAB;"></textarea>
							   </div>
							   <div class="full field">
							      <div class="center">
							      	<button type="submit" id ="send">Send</button></div>
							   </div>
						   </fieldset>
						</form>
					</div>
                 </div>
               </div>			  
           </div>
        </div>
	<!-- end section -->

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


   
</body>

</html>

<script type="text/javascript">
    
function send_mail(){
    var name = $('#name').val();
    var email = $('#email').val();
    var phonenumber = $('#phonenumber').val();
    var subject = $('#subject').val();
    var message = $('#message').val();

    if(!name || !email || !phonenumber || !subject || !message){

        $('#err_msg').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Please fill out all sections</div>');
    } else {
        $('#err_msg').html('');
        $.ajax({
            url:"email/sendmail.php",  
                method:"post",  
                data:{
                    name:name,
                    email:email,
                    phonenumber:phonenumber,
                    subject:subject,
                    message:message
                },
                dataType:"text",  
                success:function()  
                { 
                    $('#err_msg').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-success animated swing infinite"></i> Message Succesfully Sent</div>');
                },
                error: function (jqXhr, textStatus, errorThrown) {
                    $('#err_msg').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Error</div>');
                    console.log(jqXhr + " || " + textStatus + " || " + errorThrown);
                }  

        });
    }
}

    function clear_fields(){
        $('#name').val('');
        $('#email').val('');
        $('#phonenumber').val('')
        $('#subject').val('')
        $('#message').val('');
    }

    $( document ).ready(function() {
        $('#send').click(function(){
             send_mail();
             clear_fields();
             return false;
        });

    });

</script>