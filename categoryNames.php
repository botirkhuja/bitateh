<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require "api/functions.php";

  	global $con;

	// Setting query to get items using PHP PDO
	$stmtResult = array();
  	$itemsSTMT = $con->query('SELECT categories.CategoryID, categories.CategoryName, categories.CategoryImage FROM categories INNER JOIN items ON categories.CategoryID = items.CategoryID');
  	// $stmt = $con->prepare('SELECT CategoryID, CategoryName, CategoryImage FROM categories WHERE CategoryID = ?');
  	// while ($row = $itemsSTMT->fetch(PDO::FETCH_ASSOC))	
  	// {
  	// 	$stmt->execute(array($row['CategoryID']));
  	// 	$stmtResult[] = $stmt->fetch(PDO::FETCH_ASSOC);
  	// }
  	
	// $json=json_encode($stmtResult);
  	// Returning the result
	// echo $json;

	echo json_encode($itemsSTMT->fetchAll(PDO::FETCH_ASSOC));


	// checking results by outputting to text file
	// $outp = print_r($rows, true);
	// $myfile = fopen("testfile.txt", "w");
	// fwrite($myfile, $outp);
	// fclose($myfile);

	
?>