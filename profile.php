<?php
session_start();
require_once 'db.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Security Check: Redirect to login if not signed in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

// Fetch the most up-to-date info from the database
$stmt = $mysqli->prepare("SELECT student_id, email, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
$stmt->close();

echo $twig->render("profile.html", [
    'session' => $_SESSION,
    'user'    => $user_data
]);