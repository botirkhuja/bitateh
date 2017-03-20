<?php

//	include "../functions/functions.php";
    include "../../api/functions.php";
// Array with names

    global $con;

    $result = $con->query('SELECT categories.CategoryID, categories.CategoryName, categories.CategoryImage FROM categories');



    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $cat_id = $row['CategoryID'];
        $cat_title = $row['CategoryName'];

        $a[] = $cat_title;
    }

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