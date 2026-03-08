<?php
session_start();
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