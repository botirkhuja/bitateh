<?php
     header('Content-Type: application/json');
     include "../functions/functions.php";

     global $localhost, $username, $password, $database;
        $con = new mysqli($localhost, $username, $password, $database);

        /* check connection */
        if ($con->connect_errno) {
            printf("Connect failed: %s\n", $con->connect_error);
            exit();
        }

        $query = "select product_id, product_title, product_price, product_image, product_desc from products 
        order by product_id asc";
        $result = $con->query($query);

        $product = array();
        $prod = array();

        while ($row = mysqli_fetch_array($result)) {
           
            $prod['id'] = $row['product_id'];
            $prod['title'] = $row['product_title'];
            $prod['price'] = $row['product_price'];
            $prod['image'] = $row['product_image'];
            $prod['description'] = $row['product_desc'];

            array_push($product, $prod);
        }    

        echo json_encode($product);

 ?>