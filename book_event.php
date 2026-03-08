<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
  $event_id = (int) $_POST['event_id'];
  $user_id = $_SESSION['user_id'];

  $stmt = $mysqli->prepare("INSERT IGNORE INTO event_bookings (user_id, event_id) VALUES (?, ?)");
  $stmt->bind_param("ii", $user_id, $event_id);
  $stmt->execute();
  $stmt->close();
}

header("Location: events.php");
exit();
?>