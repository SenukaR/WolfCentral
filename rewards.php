<?php
session_start();

header("Content-Security-Policy: default-src 'self'; img-src 'self' https://ui-avatars.com data:; frame-src 'self' https://www.google.com; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; frame-ancestors 'self';");

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

echo $twig->render("simple-page.html", [
  'session' => $_SESSION,
  'title' => 'Rewards',
  'heading' => 'Student Rewards',
  'message' => 'Rewards, offers, and student benefits will appear here.'
]);
?>