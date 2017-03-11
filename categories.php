<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	//connecting to database link
	require "api/functions.php";

	// Requesting a selected category id
  	$selectedCategory = $_REQUEST;

  	// getting connection
  	global $con;

	// Setting query to get items using PHP PDO
	$stmt = $con->prepare('SELECT ItemID, CategoryID, Title, Model, Brand, Price, Description, Img, SellerID FROM items WHERE CategoryID = :CategoryID');
	$stmt->execute(['CategoryID' => $selectedCategory['CategoryID']]);
	$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($result);
?>