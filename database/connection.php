<?php 
/*
	$host = "localhost";
	$username = "barry";
	$password = 'Amadou90';
	$database =  "ecommerce"; 
*/
	$host = 'localhost';
	$username = 'root';
	$password = 'root';
	$database = 'ecommerce';

	$ipAddress = getIpAddress();

	define("HOST", $host, true);
	define("USER", $username, true);
	define("PASSWORD", $password, true);
	define("DATABASE", $database, true);

	$con = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD); 
	$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


?>