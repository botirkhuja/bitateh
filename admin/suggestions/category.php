<?php

	include "../functions/functions.php";
// Array with names
    global $localhost, $username, $password, $database;
    $con = new mysqli($localhost, $username, $password, $database);

    /* check connection */
    if ($con->connect_errno) {
        printf("Connect failed: %s\n", $con->connect_error);
        exit();
    }

    $query = "select cat_id, cat_title from categories";
    $result = $con->query($query);

    while ($row = mysqli_fetch_array($result)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        $a[] = $cat_title;
    }
    $result->close();
    $con->close();

// get the q parameter from URL
$categories = $_REQUEST["categories"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($categories !== "") {
    $categories = strtolower($categories);
    $len=strlen($categories);
    foreach($a as $name) {
        if (stristr($categories, substr($name, 0, $len))) {
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