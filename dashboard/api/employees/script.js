// read 
function read(){
	var search = $('#search').val();
	var data_view = $('#data_view_ip').text();
	$.get(
		"api/employees/read.php",
		{
			search:search,
			data_view:data_view
		},
		function (data, status) {
        	$("#data_container").html(data);
    	}
    );
} 

function clear_add_field() {

	$("#add_username").val("");
	$("#add_email").val("");
	$("#add_phone").val("");
	$("#add_type").val("");
}

// add
function add_submit(){
	// pull in values/variables
	var username = $("#add_user_name").val();
	var email = $("#add_email").val();
	var phone = $("#add_phone_number").val();
	var workgroup = $("#add_work_group").val();


	if (!username || !email || !phone || !workgroup ) {
		$('.add_op').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> Please fill out all sections</div>');
	} else {

		    $.ajax({  
		        url:"api/employees/add.php",  
		        method:"post",  
		        data:{
		        	username:username,
		        	email:email,
		        	phone:phone,
		        	workgroup:workgroup
		        },  
		        dataType:"text",  
		        success:function(data)  
		        {  
		        	// refresh data
		            read();  
		
		            // check result from database
		            var result = JSON.parse(data);
		            if (result.status == 'success') {
		            	read();
		            	$("#add_modal").modal("hide");
					    $('#op').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check"></i> Employee Added Succesfully.</div>');
		            } else {
		            	$('.add_op').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> Error ' + result.message + '</div>');
		            }
		            setInterval(function(){
					          $('#op').html('');
					 }, 5000);
		
		            // clear the fields
		            clear_add_field();
		        },
		        error: function (jqXhr, textStatus, errorThrown) {
		            //$('#_op').html(jqXhr + textStatus + errorThrown);
		            alert("Error!");
		        } 
		    }); 

		} 
}


// update
// get details
function getDetails(id){
	// Add User ID to the hidden field for future usage
    $("#edit_id").val(id);
    $.post("api/employees/getDetails.php", {
            id: id
        },
        function (data, status) {
        	console.log(data);
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#edit_user_name").val(user.username);
            $("#edit_email").val(user.email);
            $("#edit_phone_number").val(user.phone);
            $("#edit_work_group").val(user.workgroup);			        
        }
	);
	
	
    // Open modal popup
    $("#edit_modal").modal("show");
    // document.getElementById('_update_modal').style.display='block';
}

// update details
function edit_submit(){
	// get values
    var id = $("#edit_id").val();
    var username = $("#edit_user_name").val();
    var email = $("#edit_email").val();
    var phone = $("#edit_phone_number").val();
    var workgroup = $("#edit_work_group").val();
   
 
    // Update the details by requesting to the server using ajax
    $.post("api/employees/updateDetails.php", {
    		//record id
            id: id,

            //variables
            username: username,
            email: email,
            phone: phone,
            workgroup: workgroup
            
        },

        function (data, status) {
        	console.log(data);
        	var response = JSON.parse(data);

        	if (response.status == 'success') {
        		read();
        		$('#op').html('<div class="alert alert-success animated bounce" role="alert">Record Updated</div>');
        		$("#edit_modal").modal("hide");
        		setInterval(function(){
					$('#op').html('');
				}, 5000);

        	} else {
        		$('#edit_op').html('<div class="alert alert-danger animated pulse" role="alert">Error</div>');
        	}

        }
    );
}


// reset
function reset_btn(id){
	$('#reset_id').val(id);
	$("#reset_modal").modal("show");
}

function reset_submit(){
	var user_id = $('#reset_id').val();
	var pwd = $('#reset_password').val();
	var pwd_rpt = $('#reset_password_repeat').val();

	if (!pwd || !pwd_rpt) {
		$('.reset_op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning"></i> Please fill all fields</div>');
	} else if (pwd != pwd_rpt) {
		$('.reset_op').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> Passwords do not match</div>');
	} else {
		$.ajax({  
		    url:"api/employees/reset_password.php",  
		    method:"post",  
		    data:{
		    	pwd:pwd,
		    	user_id:user_id
		    },  
		    dataType:"text",  
		    success:function(data)  
		    {  
		          // $('#result').html(data);  
		          console.log(data);
		    	try {
					var response = JSON.parse(data);

					if (response.status == 'success') {
						read();
						$('#op').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check"></i> Password has been reset</div>');
						// clear_add_fields();
						$("#reset_modal").modal("hide");

					} else if (response.status == 'error') {
						$('.reset_op').html('<div class="alert alert-danger animated pulse infinite" role="alert"><i class="fa fa-warning"></i> Error!</div>');
					}
				} catch(e) {
					$('.reset_op').html('<div class="alert alert-danger animated pulse infinite" role="alert"><i class="fa fa-warning"></i> Error!</div>');
				}
		    },
		    error: function (jqXhr, textStatus, errorThrown) {
		        console.log(data);
		        //$('#acc_in_username_op').html(jqXhr + textStatus + errorThrown);
		    } 
		});  
	}
}



// delete
function deleteDetails(id){
	var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf == true) {
        $.post("api/employees/delete.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                read();
                $('#op').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check"></i>Record Deleted</div>');
                setInterval(function(){
					$('#op').html('');
				}, 5000);
            }
        );
    }
}



// doc ready
$( document ).ready(function() {
// jq loader
// jq loader
	$(document).ajaxStart(function(){
	    $("#jq_loader").css("display", "block");
	});
	$(document).ajaxComplete(function(){
	    $("#jq_loader").css("display", "none");
	});

// datatables
	$('.table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

// main crud
   read(); 

// search
   $('#search').on('keyup', function(){
    	read();
    	// console.log("data");
    });

// add
	$('#add_btn').click(function(){
		// getCategories("#add_type");
		$("#add_modal").modal("show");
		return false;
	});

	$('#add_submit').click(function(){
		add_submit();
		return false;
	});

	// pwd validation
	$('#add_password_repeat').keyup(function(){
		var pwd = $('#add_password').val();
		var rpt_pwd = $(this).val();
		if (rpt_pwd != pwd) {
			$(this).css("background-color", "#D79898");
		} else {
			$(this).css("background-color", "#BBE1B6");
			$('#add_password').css("background-color", "#BBE1B6");
		}
	});

	$('#add_password').keyup(function(){
		var pwd = $('#add_password_repeat').val();
		var rpt_pwd = $(this).val();
		if (rpt_pwd != pwd) {
			$(this).css("background-color", "#D79898");
		} else {
			$(this).css("background-color", "#BBE1B6");
			$('#add_password_repeat').css("background-color", "#BBE1B6");
		}
	});

// edit
	$('#edit_submit').click(function(){
		edit_submit();
		return false;
	});

   $('#close_edit_modal').click(function(){
   		$("#edit_id").val("");
	    $("#edit_surname").val("");
	    $("#edit_othername").val("");
	    $("#edit_nationalid").val("");
	    $("#edit_phonenumber").val("");
	    $("#edit_type").val("");
	    // alert("cleared");
	    $("#edit_modal").modal("hide");
   	return false;
   });

// password reset
	$('#reset_password_repeat').keyup(function(){
		var pwd = $('#reset_password').val();
		var rpt_pwd = $(this).val();
		if (rpt_pwd != pwd) {
			$(this).css("background-color", "#D79898");
		} else {
			$(this).css("background-color", "#BBE1B6");
		}
	});

	

	$('#reset_submit').click(function(){
		reset_submit();
		return false;
	});

// reports
	$('#reports_btn').click(function(){
		$("#reports_modal").modal("show");
		return false;
	});

	
// table view / card view
	$('#data_view_btn').click(function(){
		var data_view = $('#data_view_ip').text();
		
		if (data_view == 'table') {
			$('#data_view_ip').text("card");
			$('#data_view_btn').html('<i class="fa fa-table"></i> Table View');
		} else if (data_view == 'card') {
			$('#data_view_ip').text("table");
			$('#data_view_btn').html('<i class="fa fa-id-card"></i> Card View');
		}
		read();
		console.log('view changed');
		return false;
	});

});