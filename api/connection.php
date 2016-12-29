<?php 
/*
	$host = "localhost";
	$username = "root";
	$password = 'admin';
	$database =  "bitateh"; 
*/
	$host = 'localhost';
	$username = 'root';
	$password = 'admin';
	$database = 'bitateh';

	$ipAddress = getIpAddress();

	define("HOST", $host, true);
	define("USER", $username, true);
	define("PASSWORD", $password, true);
	define("DATABASE", $database, true);

	$opt = [
				PDO::ATTR_ERRMODE				=>	PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE	=>	PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES		=>	false,
			];

	$con = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD, $opt); 

?>