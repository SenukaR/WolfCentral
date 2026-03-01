<?php
// Set this to true when at home to run the site with XAMPP
// Set this to false when at University to run the site with MI-Linux
$is_home = true;

if ($is_home) {
    // HOME SETTINGS (XAMPP)
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db2432452";
} else {
    // UNIVERSITY SETTINGS (Linux Server)
    $host = "localhost";
    $user = "2432452";
    $pass = "zhnukv";
    $db = "db2432452";
}

// Create connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_errno) {
    die("Database Connection Failed: " . $mysqli->connect_error);
}
?>