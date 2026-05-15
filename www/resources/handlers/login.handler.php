<?php

session_start();

// Author: Sean Boa and Callum Flanagan
// Date: April-May 2026

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../classes/DatabaseHandler.php';
require_once __DIR__ . '/../classes/LoginController.php';


$studentNumber = '';
$password = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    //Get username & password, removing any spaces before/after - Callum
    $studentNumber = trim($_POST['username']);
    $password = trim($_POST['password']);


    //Checking if username/password is blank
    if (empty($studentNumber) || empty($password)) {
        if (empty($studentNumber)) {
            $_SESSION['errors']['login']['studentNumber'][] = 'Student Number is required';
        }
        if (empty($password)) {
            $_SESSION['errors']['login']['password'][] = 'Password is required';
        }
        header('Location: ../../login.php?errors=1');
    }
    $loginController = new LoginController($studentNumber, $password);
    $loginController->login();
} else {
    header('Location:login.php?loginfail=1');
}
