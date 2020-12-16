<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

	$user_id = $_SESSION['id'];

} else {
	
	$user_id = "intruder";
}

include 'db.php';

// instantiate database and user_class objects
$database = new Database();
$link = $database->getConnection_mysqli();

// ip ad
if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
{
	$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
{
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
	$ip=$_SERVER['REMOTE_ADDR'];
}

// date time
date_default_timezone_set("Africa/Nairobi");
$date_time = date('m/d/Y');
$time = date('H:i:s');

// page name
if (!$page_name) {
	$page_name = 'invalid';
}

$query = "SELECT username FROM users WHERE id = '".$user_id."'";
$output  = mysqli_query($link, $query);
$row = mysqli_fetch_array($output);
$num = mysqli_num_rows($output);
if ($num > 0){

	$user_id = $row["username"];
	//structure the query
	$sql  = "insert into";
	$sql .= " page_count";
	$sql .= " (ip_ad, user_id, date_time, time, page)";
	$sql .= " values";
	$sql .= " ('$ip', '$user_id', '$date_time', '$time', '$page_name')";

	//run query
	$result = mysqli_query($link, $sql);

	if ($result) {
	    // echo "Successful query";
	} else {
	    echo mysqli_error($link);
	}
} else {

	$sql  = "insert into";
	$sql .= " page_count";
	$sql .= " (ip_ad, user_id, date_time, time, page)";
	$sql .= " values";
	$sql .= " ('$ip', '$user_id', '$date_time', '$time', '$page_name')";

	//run query
	$result = mysqli_query($link, $sql);

	if ($result) {
	    // echo "Successful query";
	} else {
	    echo mysqli_error($link);
	}
}



?>



