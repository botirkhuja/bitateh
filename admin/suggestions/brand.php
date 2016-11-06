<?php
	require "../functions/functions.php";
// Array with names
    global $localhost, $username, $password, $database;
    $con = new mysqli($localhost, $username, $password, $database);

    /* check connection */
    if ($con->connect_errno) {
        printf("Connect failed: %s\n", $con->connect_error);
        exit();
    }


    $query = "select brand_id, brand_title from brands;";
    $result = $con->query($query);

    while ($row = mysqli_fetch_array($result)) {

        $brand_id = $row['brand_id'];
        $brand_title = $row['brand_title'];

        $a[] = $brand_title;
    }

    $con->close();

// get the q parameter from URL
$brands = $_REQUEST["brands"];

$hint = "";


// lookup all hints from array if $q is different from "" 
if ($brands !== "") {
    $brands = strtolower($brands);
    $len = strlen($brands);

    foreach($a as $name) {
        
        if (stristr($brands, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "" : $hint;

?>