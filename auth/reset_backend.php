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
		$serial = htmlspecialchars(mysqli_escape_string($con, $_POST['serial']));

		// check if pwds match
		if ($new_pwd !== $new_pwd_rpt) {
			$response['status'] = 'warning';
    		$response['message'] = "Passwords do not match!";
		} else {
			// get user id from serial no
				//structure query
				$sql_0  = "SELECT *"; 
				$sql_0 .= " FROM pwd_rst";
				$sql_0 .= " where serial='".$serial."' limit 1";

				//run query
				$result_0 = mysqli_query($con, $sql_0);
				
				

				if ($result_0) {
					$response_num_rows_0 = mysqli_num_rows($result_0);

					if ($response_num_rows_0 > 0) {
						$row_0 = mysqli_fetch_array($result_0);
						$user_id = $row_0["user_id"];
						// update value of pwd_rst.status to 1			
							$sql_1  = "UPDATE"; 
							$sql_1 .= " pwd_rst"; 
							$sql_1 .= " SET"; 
							$sql_1 .= " status='1' WHERE serial='".$serial."'"; 
							$sql_1 .= ""; 

							//run query
							$result_1 = mysqli_query($con, $sql_1);
							if ($result_1) {
								$new_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
								// update passwords
									$sql_2  = "UPDATE"; 
									$sql_2 .= " users"; 
									$sql_2 .= " SET"; 
									$sql_2 .= " password='".$new_pwd."' WHERE id='".$user_id."'"; 
									$sql_2 .= ""; 

									//run query
									$result_2 = mysqli_query($con, $sql_2);

									if (!$result_2) {
										$response['status'] = 'warning';
    									$response['message'] = "Error 2-1 : Contact System Admin";
									} else {
										$response['status'] = 'success';
    									$response['message'] = "Password updated succesfully";
									}
							} else {
								$response['status'] = 'warning';
    							$response['message'] = "Error 1-1 : Contact System Admin ";
							}
					} else {
						$response['status'] = 'warning';
    					$response['message'] = "Error 0-2 : Contact System Admin";
					}
					
				} else {
					$response['status'] = 'warning';
    				$response['message'] = "Error 0-1 : Contact System Admin";
				}
		}	

	} else {
		$response['status'] = 200;
    	$response['message'] = "Invalid Request!";
	}

	

	echo json_encode($response);

?>



