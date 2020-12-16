<?php

use \Mailjet\Resources;
require '../vendor/mailjet/vendor/autoload.php';
    
//Send Mail function
function send_email($mj_from_email, $mj_from_name, $mj_to_email, $mj_to_name, $mj_subject, $mj_text, $mj_html){

    $mj_public_key = 'dd4c0a8351f16622dcc1a7208d5b12ec';
    $mj_private_key = 'c7269d0072a31ba952cbafdbc300e116';

    $mj = new \Mailjet\Client($mj_public_key, $mj_private_key,true,['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $mj_from_email,
                    'Name' => $mj_from_name
                ],
                'To' => [
                    [
                        'Email' => $mj_to_email,
                        'Name' => $mj_to_name
                    ]
                ],
                'Subject' => $mj_subject,
                'TextPart' => $mj_text,
                'HTMLPart' => $mj_html
            ]
        ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    //$response->success() && var_dump($response->getData());
}
// Include config file
require_once "db.php";

// instantiate database and user_class objects
$database = new Database();
$con = $database->getConnection_mysqli();

   
// check request
if(isset($_POST['email']) && isset($_POST['email']) != "")
{
	// init response array
	$response = array();

    // get User ID
    $email = trim($_POST['email']);
 
    // Get User Details
    $query = "SELECT * FROM users WHERE email = '$email' limit 1";
    $result = mysqli_query($con, $query);
    if (!$result) {
        $response['status'] = 503;
    	$response['message'] = "Internal Error";
    } else {    
	    if(mysqli_num_rows($result) > 0) {
	    	// get user info
	    		$row = mysqli_fetch_assoc($result);
	    		$user_name = $row['username'];
	    		$user_id = $row["id"];

	        // generate serial
	    		$serial = md5($row["id"] . "_" . time());

	        // insert into pwd_reset table
	        	$sql  = "insert into";
	        	$sql .= " pwd_rst";
	        	$sql .= " (serial, user_id, date_time)";
	        	$sql .= " values";
	        	$sql .= " ('" . $serial . "', '" . $user_id . "', '" . time() . "')";

	        	

	        	//run query
	        	$res = mysqli_query($con, $sql);
	        	if (!$res) {
	        		$response['status'] = "warning";
	        		$response['message'] = "Error, contact System admin.";
	        	} else {

		        	// send pwd reset link
		    	    $mj_from_email = 'cmapp@triples.co.ke';
		    	    $mj_from_name = 'CMAPP DSAIL';
		    	
		    	    $mj_to_email = $email;
		    	    $mj_to_name = $user_name;
		    	
		    	    $mj_subject = 'Password Reset';
		    	    $mj_text = "Hello " . strtoupper($mj_to_name) . " .\n";
		    	    $mj_text .= "Use the link below to reset your password. The link shall expire in 3 hours .\n";
		    	    $mj_text .= "Password reset link : http://139.59.142.183/cmapp/auth/reset.php?rst=".$serial.".\n";
		    	    $mj_html = '';

		    	    send_email($mj_from_email, $mj_from_name, $mj_to_email, $mj_to_name, $mj_subject, $mj_text, $mj_html);


		    	    $response['status'] = "success";
	        		$response['message'] = "Password reset link sent to email";
		    	}
		     
	    }
	    else
	    {
	        $response['status'] = "warning";
	        $response['message'] = "No such email account, Please Sign up to create an account";
	    }
	   
	}
    
    
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}

echo json_encode($response);

		