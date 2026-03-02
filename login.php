<?php
session_start();
require_once 'db.php';
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_input = $_POST['email'];
    $pass_input = $_POST['password'];

    // Updated SELECT to include 'email' and 'student_id'
    $stmt = $mysqli->prepare("SELECT id, student_id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($pass_input, $user['password'])) {
            // Save everything we need to the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['email'] = $user['email']; 

            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that email.";
    }
    $stmt->close();
}

echo $twig->render("login.html", [
    'session' => $_SESSION,
    'error' => $error
]);
?>