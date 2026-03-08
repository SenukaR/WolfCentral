<?php
session_start();
require_once 'db.php';
require_once __DIR__ . '/../vendor/autoload.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

$dashboard = [
  'booked_events' => [],
  'booked_count' => 0,
  'next_event' => null
];

$user_id = $_SESSION['user_id'];

// Get booked events
$stmt = $mysqli->prepare("
    SELECT e.title, e.event_date, e.location
    FROM event_bookings eb
    INNER JOIN events e ON eb.event_id = e.id
    WHERE eb.user_id = ?
    ORDER BY e.event_date ASC
    LIMIT 3
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$dashboard['booked_events'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Count total bookings
$stmt = $mysqli->prepare("
    SELECT COUNT(*) AS total
    FROM event_bookings
    WHERE user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$count_result = $stmt->get_result()->fetch_assoc();
$dashboard['booked_count'] = $count_result['total'] ?? 0;
$stmt->close();

// Get next upcoming event
$stmt = $mysqli->prepare("
    SELECT e.title, e.event_date, e.location
    FROM event_bookings eb
    INNER JOIN events e ON eb.event_id = e.id
    WHERE eb.user_id = ?
    AND e.event_date >= NOW()
    ORDER BY e.event_date ASC
    LIMIT 1
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$dashboard['next_event'] = $stmt->get_result()->fetch_assoc();
$stmt->close();

echo $twig->render("dashboard.html", [
  'session' => $_SESSION,
  'dashboard' => $dashboard
]);
?>