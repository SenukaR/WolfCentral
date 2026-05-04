<?php
session_start();

// Sends the Content-Security-Policy header directly
header("Content-Security-Policy: default-src 'self'; img-src 'self' https://ui-avatars.com data:; frame-src 'self' https://www.google.com; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; frame-ancestors 'self';");

require_once 'db.php';
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

$stmt = $mysqli->prepare("
    SELECT e.id, e.title, e.description, e.event_date, e.location,
           CASE 
               WHEN eb.id IS NOT NULL THEN 1
               ELSE 0
           END AS is_booked
    FROM events e
    LEFT JOIN event_bookings eb
        ON e.id = eb.event_id
        AND eb.user_id = ?
    ORDER BY e.event_date ASC
");

$user_id = $_SESSION['user_id'] ?? 0;
$stmt->bind_param("i", $user_id);
$stmt->execute();
$events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

echo $twig->render("events.html", [
  'session' => $_SESSION,
  'events' => $events
]);
?>