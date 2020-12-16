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
    // $ctgr_update_id = $_POST['ctgr_update_id'];
    $user_id = $_POST['user_id'];
    
    $pwd = mysqli_real_escape_string($con, htmlspecialchars($_POST['pwd']));
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    
 
    // Update User details
    $query = "UPDATE employees SET password = '$pwd' WHERE id = '$user_id'";
    if (!$result = mysqli_query($con, $query)) {
        
        $data = [
            'status' => 'error',
            'message' => exit(mysqli_error($con))
        ];
    } else {
        $data = [
            'status' => 'success',
            'message' => 'one record added'
        ];


    }
    $data = json_encode($data);
    echo $data;
}



