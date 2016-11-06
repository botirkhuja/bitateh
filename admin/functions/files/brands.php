<?php

     header('Content-Type: application/json'); 
     include "../../../api/functions.php";

     global $host, $username, $password, $database;
        $con = new mysqli($localhost, $username, $password, $database);

        /* check connection */
        if ($con->connect_errno) {
            printf("Connect failed: %s\n", $con->connect_error);
            exit();
        }

        $query = "select brand_id, brand_title from brands";
        $result = $con->query($query);

        $brands = array();
        $brand = array();

        while ($row = mysqli_fetch_array($result)) {
            $brand['title'] = $row['brand_title'];
            $brand['id'] = $row['brand_id'];

            array_push($brands, $brand);
      
        }

        $con->close();
        echo json_encode($brands);
?>