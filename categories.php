<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	//connecting to database link
	include "api/functions.php";

  	$selectedCategory = $_REQUEST;

  	// $servername = "localhost";
  	// $username = "root";
  	// $password = "admin";
  	// $dbname = "bitateh";

  	global $host;
  	global $username;
  	global $password;
  	global $database;

  	// Create connection
	$conn = new mysqli($host, $username, $password, $database);
	// Check connection
	if ($conn->connect_errno) {
    	die("Connection failed: " .$conn->connect_error);
        exit();
	}

	// Setting query to get items
	$sql = "SELECT ItemID, CategoryID, Title, Price, Img FROM items WHERE CategoryID = " .$selectedCategory["CategoryID"];
	$result = $GLOBALS['conn']->query($sql);

	$jsonResult = array();
	while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	  	// if ($jsonResult != "") {$jsonResult .= ",";}
	  	// $jsonResult .= '{"ItemID":"' 	.$rs[ItemID]	.'",';
	  	// $jsonResult .= '"CategoryID":"'	.$rs[CategoryID]	.'",';
	  	// $jsonResult .= '"Title":"' 		.$rs[Title]	.'",';
	  	// $jsonResult .= '"Price":"'		.$rs[Price]	.'"}';
	  	$jsonResult[] = $rs;
	}
	// $jsonResult = '{"records":['.$jsonResult.']}';
	$result->close();
	$conn->close();
	echo json_encode($jsonResult);
	// echo ($jsonResult);
?>