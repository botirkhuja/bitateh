<?php
	header("Access-Control-Allow-Origin: *");
	require "api/functions.php";

	// Request or receive data
	$data = $_REQUEST;

	// Filter received data
	foreach ($data['payer'] as $key => $value) {
		$value = filterInput($value);
	}
	
	if (insert_buyer($data['payer']) && ) {
		# code...
	}

	// Database access
	global $con;
	// $result = $con->prepare("INSERT INTO")

	$outp = print_r($data, true);
	// foreach ($orderInformation as $key => $value) {
	// 	$outp = $key . "=" . $value;
	// }
	$myfile = fopen("testfile.txt", "w");
	fwrite($myfile, $outp);
	fclose($myfile);

?>