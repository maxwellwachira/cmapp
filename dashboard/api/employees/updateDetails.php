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
    $id = mysqli_real_escape_string($con, htmlspecialchars($_POST['id']));
    $username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username']));
    $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email']));
    $phone = mysqli_real_escape_string($con, htmlspecialchars($_POST['phone']));
    $workgroup = mysqli_real_escape_string($con, htmlspecialchars($_POST['workgroup']));
    
 
    // Update User details
    $query = "UPDATE employees 
    			SET 
    			username = '$username', 
    			email = '$email', 
    			phone = '$phone',
                workgroup = '$workgroup'  
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
            'message' => 'one record edited'
        ];
    }
    $data = json_encode($data);
    echo $data;
}