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
     $task = mysqli_real_escape_string($con, htmlspecialchars($_POST['task']));
     $description = mysqli_real_escape_string($con, htmlspecialchars($_POST['description']));
     $start_date = mysqli_real_escape_string($con, htmlspecialchars($_POST['start_date']));
     $completion_date = mysqli_real_escape_string($con, htmlspecialchars($_POST['completion_date']));
     $assign_task = mysqli_real_escape_string($con, htmlspecialchars($_POST['employee_id']));
    
 
    // Update User details
    $query = "UPDATE tasks 
    			SET 
    			task = '$task', 
    			description = '$description', 
    			start_date = '$start_date',
                completion_date = '$completion_date',
                employee_id = '$assign_task'
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