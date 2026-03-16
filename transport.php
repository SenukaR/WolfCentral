<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

// Dummy data
$buses = [
  ['route' => 'Campus_Wlv', 'departure' => '08:00', 'arrival' => '08:30', 'frequency' => 'Every 30 mins'],
  ['route' => 'Campus_Wal', 'departure' => '08:00', 'arrival' => '08:30', 'frequency' => 'Every 30 mins'],
  ['route' => 'Campus_Tel', 'departure' => '09:00', 'arrival' => '09:45', 'frequency' => 'Every 1 hr']
];

$trains = [
  ['station' => 'Wolverhampton', 'departure' => '08:15', 'arrival' => '08:45', 'notes' => 'Direct'],
  ['station' => 'Coventry > ', 'departure' => '09:30', 'arrival' => '10:10', 'notes' => 'Change at Coventry'],
  ['station' => 'Coventry', 'departure' => '09:30', 'arrival' => '10:10', 'notes' => '']
];

$tram = [
  ['route' => '1', 'schedule' => 'Every 20 mins 08:00–18:00', 'notes' => 'Stops at main buildings'],
  ['route' => '2', 'schedule' => 'Every 30 mins 08:15–17:45', 'notes' => 'Limited weekends']
];

$parking = [
  ['location' => 'North Parking Lot', 'spaces' => 'X', 'notes' => 'Student permits only'],
  ['location' => 'South Parking Lot', 'spaces' => 'Y', 'notes' => 'Visitor parking available']
];

echo $twig->render("transport.html", [
  'session' => $_SESSION,
  'heading' => 'Transport Information',
  'buses' => $buses,
  'trains' => $trains,
  'tram' => $tram,
  'parking' => $parking
]);
?>