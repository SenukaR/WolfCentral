<?php
// Disable default error reporting for mysqli to handle it manually
mysqli_report(MYSQLI_REPORT_OFF);

try {
    // 1. TRY UNIVERSITY SETTINGS (Linux Server)
    $host = "localhost";
    $user = "2432452";
    $pass = "zhnukv";
    $db   = "db2432452";

    $mysqli = new mysqli($host, $user, $pass, $db);

    // If there is a connection error, throw an exception to trigger the 'catch' block
    if ($mysqli->connect_errno) {
        throw new Exception($mysqli->connect_error);
    }

} catch (Exception $e) {
    // 2. FALLBACK TO HOME SETTINGS (XAMPP)
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "db2432452";

    $mysqli = new mysqli($host, $user, $pass, $db);

    // Final check: If both fail, then we die
    if ($mysqli->connect_errno) {
        die("Database Connection Failed on both environments: " . $mysqli->connect_error);
    }
}

// Re-enable standard error reporting for your queries
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>