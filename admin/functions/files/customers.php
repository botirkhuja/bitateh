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

        $query = "select customer_id, customer_name, customer_phone, customer_email from customers";
        $result = $con->query($query);

        $display = "";
        $customers = array();
        $customer = array();

        while ($row = mysqli_fetch_array($result)) {
            $customer['id'] = $row['customer_id'];
            $customer['name'] = $row['customer_name'];
            $customer['email'] = $row['customer_email'];
            $customer['phone'] = $row['customer_phone'];

            array_push($customers, $customer);
        }

        $con->close();
        echo json_encode($customers);

?>