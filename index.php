<?php
session_start();
require_once 'db.php';
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

// We pass the session here so layout.html -> navigation.html can see it
echo $twig->render("home.html", [
  'session' => $_SESSION
]);
?>