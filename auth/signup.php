<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


date_default_timezone_set("Africa/Nairobi");

// include database 
include_once 'db.php';
// include user class 

// instantiate database and user_class objects
$database = new Database();
$db = $database->getConnection_pdo();

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->username) &&
    !empty($data->email) &&
    //!empty($data->a_type) &&
    !empty($data->password) 
){

	$email_validity = filter_var($data->email, FILTER_SANITIZE_EMAIL);

	if ($email_validity){

		$email = $data->email;
	
		// select query
	    $query = "SELECT email FROM 
	     			users 
	     			WHERE email = ?
	     			LIMIT 1";

	    
	    // prepare query statement
   		$stmt = $db->prepare($query);

	    // bind email 
	    $stmt->bindParam(1, $email);

	    // execute query
	    $stmt->execute();

		// query row count
		$num = $stmt->rowCount(); 

		// check if more than 0 record found
		if($num>0){

			// tell the user email already exists
	        echo json_encode(array("message" => "account_exists"));

		}else{

			  $query = "INSERT INTO users (username, email, password, type, created_at, deleted)
            VALUES
                (?, ?, ?, ?, ?, ?)";
  
		    // prepare query
		    $stmt = $db->prepare($query);

		    // sanitize
		    $username=htmlspecialchars(strip_tags($data->username));
		    $email=htmlspecialchars(strip_tags($data->email));
		    $password=htmlspecialchars(strip_tags($data->password));
		 

		    $password = $data->password;
		    $type = '1';
		    $created_at = date('Y/m/d H:i:s');
		    $deleted = 0;
		  
		    
		  
		    // bind values
		    $stmt->bindParam(1, $username);
		    $stmt->bindParam(2, $email);
		    $stmt->bindParam(3, $password);
		    $stmt->bindParam(4, $type);
		    $stmt->bindParam(5, $created_at);
		    $stmt->bindParam(6, $deleted);
		  
		    

			

		    // create the user
		    if($stmt->execute()){
		  
		        // set response code - 201 created
		        //http_response_code(201);
		  
		        // tell the user
		        echo json_encode(array("message" => "success"));
		    }
		  
		    // if unable to create the device, tell the user
		    else{
		  
		        // set response code - 503 service unavailable
		        http_response_code(503);
		  
		        // tell the user
		        echo json_encode(array("message" => "internal_error"));
		    }

		}

	}else{

		// tell the user email already exists
	    echo json_encode(array("message" => "invalid_email"));
	}
    
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "bad_request"));
    
}
?>