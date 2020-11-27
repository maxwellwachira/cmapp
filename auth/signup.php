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


class User_registration{
  
    // database connection and table name
    private $conn;
    private $table_name = "users";
  
    // object properties
    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                username=:username, email=:email, password=:password, created_at=:created_at";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->created_at=htmlspecialchars(strip_tags($this->created_at));
  
    // bind values
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":created_at", $this->created_at);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
    }

 }

// instantiate database and User_registration  object
$database = new Database();
$db = $database->getConnection();

$user = new User_registration($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->username) &&
    !empty($data->email) &&
    !empty($data->password) 
){

	if (filter_var($data->email, FILTER_SANITIZE_EMAIL)){

		
		// select query
	    $query = "SELECT email FROM 
	     			users 
	     			WHERE email = ?";

	    
	    // prepare query statement
   		$stmt = $db->prepare($query);

	    // bind email 
	    $stmt->bindParam(1, $email);

	    $email = $data->email;
	  
	    // execute query
	    $stmt->execute();

		// query row count
		$num = $stmt->rowCount(); 


		// check if more than 0 record found
		if($num>0){

			// tell the user email already exists
	        echo json_encode(array("message" => "account_exists"));

		}else{

			$hashed_pwd = password_hash($data->password, PASSWORD_DEFAULT);

			// set user property values
		    $user->username = $data->username;
		    $user->email = $data->email;
		    $user->password = $hashed_pwd;
		    $user->created_at = date('Y/m/d H:i:s');

		    // create the user
		    if($user->create()){
		  
		        // set response code - 201 created
		        http_response_code(201);
		  
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