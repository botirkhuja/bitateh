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

        $query = "select cat_id, cat_title from categories";
        $result = $con->query($query);

        $categories = array();
        $category = array();

        while ($row = mysqli_fetch_array($result)) {
            $category['title'] = $row['cat_title'];
            $category['id'] = $row['cat_id'];

            array_push($categories, $category);
      
        }

        $con->close();
        echo json_encode($categories);
?>