<?php
 // include Database connection file 
        
  include("../../../auth/db.php");

  // instantiate database and user_class objects
  $database = new Database();
  $con = $database->getConnection_mysqli();

  if(isset($_POST['manager_id'])){

  $manager_id = $_POST['manager_id'];

  $query = "SELECT * FROM employees where deleted=0 and manager_id = '".$manager_id."' order by id asc ";
  $result = mysqli_query($con, $query);

  if (!$result) {
  	$data = [
  		'status' => 'warning',
  		'message' => mysqli_error($con)
  	];
  } else {
	  	$num =mysqli_num_rows($result);
	  	if ($num > 0){
	  		$data=array();
	    	while ($row = mysqli_fetch_assoc($result)){
	    		$data_items = array(
	    			'name' => $row['username'],
	    			'id'=> $row['id']
	    		);
	    		array_push($data, $data_items);
	    	}
	  	} else {
	  		$data = [
	  		'status' => 'warning',
	  		'message' => 'No Record'
	  		];
	  	}
  	}
}else {
	$data = [
	  		'status' => 'warning',
	  		'message' => 'Bad Request'
	  		];
}


$data = json_encode($data);
echo $data;

?>

  