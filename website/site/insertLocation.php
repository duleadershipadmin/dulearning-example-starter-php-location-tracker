<?php
include "../constants.php";

parse_str($_SERVER['QUERY_STRING'], $params);

$name = $params['name'];
$country = $params['country'];
$city = $params['city'];
$year = $params['year'];
$month = $params['month'];
$day = $params['day'];

$conn = get_db_connection();

$conn->query("INSERT INTO locations (name, country, city, year, month, day) VALUES ('".$name."', '".$country."', '".$city."', '".$year."', '".$month."', '".$day."')");

if ($conn->error) {
    error_log("Insert failed: " . $conn->error);
}

header("location: /locations.php?nameInput=".$name."&locType=0");
die;
