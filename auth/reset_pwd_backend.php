<?php  
	
	// Include config file
    require_once "db.php";

    // instantiate database and user_class objects
    $database = new Database();
    $con = $database->getConnection_mysqli();
	
	// init response array
	$response = array();

	// /get post variables
	if (isset($_POST['new_pwd'])) {
		// get vars
		$new_pwd = htmlspecialchars(mysqli_escape_string($con, $_POST['new_pwd']));
		$new_pwd_rpt = htmlspecialchars(mysqli_escape_string($con, $_POST['new_pwd_rpt']));
		$id = htmlspecialchars(mysqli_escape_string($con, $_POST['id']));
		// check if pwds match
		if ($new_pwd !== $new_pwd_rpt) {
			$response['status'] = 'warning';
    		$response['message'] = "Passwords do not match!";
		} else {
				

			$new_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
			// update passwords
			$sql  = "UPDATE"; 
			$sql .= " users"; 
			$sql .= " SET"; 
			$sql .= " password='".$new_pwd."' WHERE id='".$id."'"; 
			$sql .= ""; 

			//run query
			$result = mysqli_query($con, $sql);

			if (!$result) {
				$response['status'] = 'warning';
				$response['message'] = "Error 2-1 : Contact System Admin";
			} else {
				$response['status'] = 'success';
				$response['message'] = "Password updated succesfully";
			}
							
		}	

	} else {
		$response['status'] = 200;
    	$response['message'] = "Invalid Request!";
	}

	

	echo json_encode($response);

?>



