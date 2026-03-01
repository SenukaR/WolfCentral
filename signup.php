<?php
session_start(); // THIS MUST BE THE VERY FIRST LINE
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'db.php'; 

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

    $stmt = $mysqli->prepare("INSERT INTO users (student_id, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_id, $email, $hashed_password);

    if ($stmt->execute()) {
        $message = "Registration successful! You can now log in.";
    } else {
        $message = "Error: Student ID or Email already exists.";
    }
    $stmt->close();
}

echo $twig->render("signup.html", [
    'session' => $_SESSION, // Now this variable exists!
    'message' => $message
]);
?>