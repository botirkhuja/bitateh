<?php
	header('Content-Type: application/json');

	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	session_destroy();

	echo json_encode(array( 'success' => true ));

?>