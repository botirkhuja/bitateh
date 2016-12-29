<?php
       if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

	print_r($_SESSION);


?>