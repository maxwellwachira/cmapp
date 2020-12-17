<?php

 include("../../../auth/db.php");

// instantiate database and user_class objects
$database = new Database();
$link = $database->getConnection_mysqli();

$query = "SELECT DISTINCT name, longitude, latitude FROM stores";

$result = mysqli_query($link, $query);
$total_entries = mysqli_num_rows($result);
			
if ($result){

	$location_data=array();
    $location_data["location"]=array();

	
	while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

		extract($row);

		 $data = array(
                    'name' => $row["name"],
                    'lat' => $row["latitude"],
                    'long' => $row["longitude"]  
                );

         array_push($location_data["location"], $data);
		
		 }


	} else {
		    echo mysqli_error($con);
}

$location_data = json_encode($location_data);
echo $location_data;