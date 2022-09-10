<?php
session_start();
    
define('TOP', dirname(__FILE__));

$names = array();

function get_db_connection()  {
    $servername = "localhost";
    $username = "local_user";
    $password = "Loca1P@sswdD";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, "location_tracker");
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    return $conn;
}