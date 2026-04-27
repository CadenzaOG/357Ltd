<?php

//

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/resources/classes/DatabaseHandler.php';
require_once __DIR__ . '/resources/classes/LoginController.php';

$studentNumber = '';
$password = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $studentNumber = $_POST['username'];
    $password = $_POST['password'];

    $loginController = new LoginController($studentNumber, $password);
    $loginController->login();
} else {
    header('Location:login.html');
}
