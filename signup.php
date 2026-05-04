<?php
session_start();

header("Content-Security-Policy: default-src 'self'; img-src 'self' https://ui-avatars.com data:; frame-src 'self' https://www.google.com; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; frame-ancestors 'self';");

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'db.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if ($student_id === '' || $email === '' || $pass === '') {
        $message = "Please fill in all fields.";
    } else {
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

        try {
            $stmt = $mysqli->prepare("INSERT INTO users (student_id, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $student_id, $email, $hashed_password);
            $stmt->execute();

            $message = "Registration successful! You can now log in.";
            $stmt->close();

        } catch (mysqli_sql_exception $e) {
            if (str_contains($e->getMessage(), 'student_id')) {
                $message = "That Student ID is already registered.";
            } elseif (str_contains($e->getMessage(), 'email')) {
                $message = "That email address is already registered.";
            } else {
                $message = "Something went wrong. Please try again.";
            }
        }
    }
}

echo $twig->render("signup.html", [
    'session' => $_SESSION,
    'message' => $message
]);
?>