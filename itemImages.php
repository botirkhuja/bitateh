<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	//connecting to database link
	require "api/functions.php";

	// Requesting a selected item id
  	$ID = $_REQUEST;

  	// getting connection
  	global $con;

	// Setting query to get items using PHP PDO
	$stmt = $con->prepare('SELECT ImageName FROM item_images WHERE ItemID = :ID');
	$stmt->execute(['ID' => $ID['ItemID']]);
	$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($result);
?>