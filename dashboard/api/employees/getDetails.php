<?php
// include Database connection file 
        
include("../../../auth/db.php");

// instantiate database and user_class objects
$database = new Database();
$con = $database->getConnection_mysqli();
 
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $id = $_POST['id'];
 
    // Get User Details
    $query = "SELECT * FROM employees WHERE id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    // display JSON data
   
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}


 echo json_encode($response);