<?php

// include Database connection file 
include("../../../auth/db.php");

// instantiate database and user_class objects
$database = new Database();
$con = $database->getConnection_mysqli();
 
// check request
if(isset($_POST['id']))
{
    // get values
    $id = $_POST['id'];
    
 
    // Update User details
    $query = "UPDATE employees 
    			SET 
    			
                deleted = 1 
    			WHERE 
    			id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        
        $data = [
            'status' => 'error',
            'message' => exit(mysqli_error($con))
        ];
    } else {
        $data = [
            'status' => 'success',
            'message' => 'one record deleted'
        ];
    }
    $data = json_encode($data);
    echo $data;
}