<?php

$isLocal = in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']);

if ($isLocal) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'db2432452';
} else {
    $host = 'localhost';
    $user = '2432452';
    $pass = 'zhnukv';
    $db = 'db2432452';
}

$mysqli = @new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    die("Database Connection Failed: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>