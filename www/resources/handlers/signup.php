<?php

require_once __DIR__.'/../classes/DatabaseHandler.php';
require_once __DIR__ . '/../classes/SignupController.php';
require_once __DIR__.'/../classes/LoginController.php';

$forename = $_POST['forename'] ?? null;
$surname = $_POST['surname'] ?? null;
$email = $_POST['email'] ?? null;
$studentNumber = $_POST['student_number'] ?? null;
$house = $_POST['house'] ?? null;
$street = $_POST['street'] ?? null;
$town = $_POST['town'] ?? null;
$postcode = $_POST['postcode'] ?? null;
$password = $_POST['password'] ?? null;
$confirmPassword = $_POST['confirm_password'] ?? null;

$signup = new SignupController(
    $forename,
    $surname,
    $email,
    $studentNumber,
    $house,
    $street,
    $town,
    $postcode,
    $password,
    $confirmPassword);

if ($signup->signup()) {
    // $login = new LoginController($studentNumber, $password);
    // $login->login();
    header('Location: /index.php?signup=success');
} else {
    header('Location: /index.php?signup=error');
}



