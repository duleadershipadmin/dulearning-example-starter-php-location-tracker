<?php
include "../constants.php";

parse_str($_SERVER['QUERY_STRING'], $params);

$name = $params['nameInput'];

if (is_null($name) || $name == "" ) {
    header("location: /?return=true");
    die;
} else {
    $localNames = $_SESSION["names"];
    if (is_null($localNames)) {
        $localNames = array();
    }
    
    if (!in_array($name, $localNames)) {
        array_push($localNames, $name);
    }
    
    $_SESSION["names"] = $localNames;
}

header("location: /locations.php?".$_SERVER['QUERY_STRING']."&locType=0");
die;