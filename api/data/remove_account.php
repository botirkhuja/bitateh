<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

    $email = $_SESSION['customer_email'];
        session_destroy();


     include "../functions.php";

     global $localhost, $username, $password, $database;
        $con = new mysqli($localhost, $username, $password, $database);

        /* check connection */
        if ($con->connect_errno) {
            printf("Connect failed: %s\n", $con->connect_error);
            exit();
        }

        $query = "delete from customers where customer_email = '$email';";
        $result = $con->query($query);
        $con->close();

        if($result)
            echo "true";

?>