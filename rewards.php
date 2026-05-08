<?php
session_start();

/* Basic security policy */
header("Content-Security-Policy: default-src 'self'; img-src 'self' https://ui-avatars.com data:; frame-src 'self' https://www.google.com; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; frame-ancestors 'self';");

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/db.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

/* Make sure the user is logged in before accessing rewards */
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

/* Show a message after redirecting back from a claim */
if (isset($_SESSION['reward_message'])) {
  $message = $_SESSION['reward_message'];
  unset($_SESSION['reward_message']);
}

/* Check if the user already has a points record */
$stmt = $mysqli->prepare("SELECT points FROM user_points WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userPoints = $result->fetch_assoc();

/* If they do not have one yet, create it with 0 points */
if (!$userPoints) {
  $points = 0;

  $stmt = $mysqli->prepare("INSERT INTO user_points (user_id, points) VALUES (?, 0)");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
} else {
  $points = $userPoints['points'];
}

/* Handle reward claims when the button is pressed */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reward_id'])) {

  $reward_id = intval($_POST['reward_id']);

  /* Get the selected reward from the database */
  $stmt = $mysqli->prepare("SELECT id, name, points_cost FROM rewards WHERE id = ?");
  $stmt->bind_param("i", $reward_id);
  $stmt->execute();

  $rewardResult = $stmt->get_result();
  $reward = $rewardResult->fetch_assoc();

  if ($reward) {

    /* Make sure the user has enough points */
    if ($points >= $reward['points_cost']) {

      $new_points = $points - $reward['points_cost'];

      /* Update the user's remaining points */
      $stmt = $mysqli->prepare("UPDATE user_points SET points = ? WHERE user_id = ?");
      $stmt->bind_param("ii", $new_points, $user_id);
      $stmt->execute();

      /* Save the reward claim */
      $stmt = $mysqli->prepare("INSERT INTO reward_claims (user_id, reward_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $user_id, $reward_id);
      $stmt->execute();

      $_SESSION['reward_message'] = "Reward claimed successfully.";

    } else {

      $_SESSION['reward_message'] = "You do not have enough points for this reward.";
    }

  } else {

    $_SESSION['reward_message'] = "Reward not found.";
  }

  /* Redirect after claiming so refreshing does not claim again */
  header("Location: rewards.php");
  exit();
}

/* Count how many rewards this user has claimed */
$stmt = $mysqli->prepare("SELECT COUNT(*) AS total FROM reward_claims WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$claimedResult = $stmt->get_result()->fetch_assoc();
$rewards_claimed = $claimedResult['total'];

/* Load all rewards from the database */
$rewards = [];

$result = $mysqli->query("SELECT id, name, description, points_cost FROM rewards ORDER BY points_cost ASC");

while ($row = $result->fetch_assoc()) {
  $rewards[] = $row;
}

/* Simple member tier system based on points */
if ($points >= 1000) {
  $member_tier = "Gold";
} elseif ($points >= 500) {
  $member_tier = "Silver";
} else {
  $member_tier = "Bronze";
}

/* Send all the data to the Twig page */
echo $twig->render("simple-page.html", [
  'session' => $_SESSION,
  'title' => 'Rewards',
  'points' => $points,
  'rewards_claimed' => $rewards_claimed,
  'member_tier' => $member_tier,
  'rewards' => $rewards,
  'message' => $message
]);
?>