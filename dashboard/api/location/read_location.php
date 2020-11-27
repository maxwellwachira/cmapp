<?php

 $host = "localhost";
 $db_name = "cmapp_web";
 $username = "root";
 $password = "Db@maxwell";

 // Create connection
$link = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}


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