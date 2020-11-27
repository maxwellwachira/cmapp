function register_submit(){
	
	// pull in values/variables
	var name = $("#name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var password_repeat = $("#confirm_password").val();

	

	//check if any of the variable is empty
	if (!name || !email  || !password || !password_repeat) {
		$('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Please fill out all sections</div>');
	} 
	else {
		
	    if (password != password_repeat) {

	    	$('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Passwords do not match</div>');

	    } else {

	    	if (Number(password.length) < 8){

	    		$('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Password Must be atleast 8 characters</div>');

	    	}else {

	    		$('#op').html('');
		    	var reg_data = {
			        	username:name,
			        	email:email,
			        	password:password
			        };

			    var json_reg_data = JSON.stringify(reg_data);
			    console.log(json_reg_data);  

			    $.ajax({  
			        url:"auth/signup.php",  
			        method:"POST",  
			        data: json_reg_data,
			        dataType: 'json',
	            	contentType: 'application/json; charset=utf-8',  
			        success:function(data)  
			        {  
			        	console.log(data);
					
			            // check result from database
			            var result = JSON.parse(JSON.stringify(data));
			            if (result.message == 'success') {
			            	
			            	$('#op').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check"></i> You have registered succesfully. Click here to log into your account <a type="button" href="#" class="btn btn-primary">Log in</a></div>');

			            } else if (result.message == 'account_exist') {
			            	$('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Account Exists!!</div>');
			            	
			            }
			
			            // clear the fields
			           	//clear_register_field();
			        },
			        error: function (jqXhr, textStatus, errorThrown) {
			            
			            $('#register_op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Error</div>');
			            console.log(jqXhr + " || " + textStatus + " || " + errorThrown);
			        } 
			    });

	    	}

	    	 

		} 
	}
}

function clear_register_field() {
	$("name").val("");
	$("#email").val("");
	$("#password").val("");
	$("#confirm_password").val("");

	$("#password").css("background-color", "white");
	$("#confirm_password").css("background-color", "white");
}

$( document ).ready(function() {

   $('form').submit(function(event){
  	event.preventDefault();
   	register_submit();
   	return false;
   });

});