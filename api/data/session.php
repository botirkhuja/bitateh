<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    ini_set('display_errors', 'On');

    $session = array();
	$session = array('email'=> $_SESSION['email'], 'firstname'=> $_SESSION['firstname'], 'lastname'=> $_SESSION['lastname']);

	echo json_encode($session);
?>