<?php
session_start(); // Start session to store user data
require_once 'db.php';
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $pass = $_POST['password'];

  // UPDATED: Added student_id to the SELECT statement
  $stmt = $mysqli->prepare("SELECT id, student_id, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($user = $result->fetch_assoc()) {
    // Verify the hashed password
    if (password_verify($pass, $user['password'])) {
      // Save data to the session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['student_id'] = $user['student_id'];

      // Redirect to home page
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