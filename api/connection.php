<?php 
/*
	$host = "localhost";
	$username = "root";
	$password = 'admin';
	$database =  "bitateh"; 
*/
	$host = 'localhost';
	$username = 'texnikou';
	$password = '73e1Zu3aqS';
	$database = 'texnikou_techs';

	$ipAddress = getIpAddress();

	define("HOST", $host, true);
	define("USER", $username, true);
	define("PASSWORD", $password, true);
	define("DATABASE", $database, true);

	$opt = array(
				PDO::ATTR_ERRMODE				=>	PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE	=>	PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES		=>	false,
				PDO::ATTR_PERSISTENT			=>	true,
			);

	$con = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD, $opt); 

?>