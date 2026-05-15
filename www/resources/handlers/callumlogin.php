<?php
//
//Author: Callum Flanagan
//Date: May 2026

require_once __DIR__ . '/resources/classes/DatabaseHandler.php';
require_once __DIR__ . '/resources/classes/LoginController.php';

//Get username & password, removing any spaces before/after
$studentNumber = trim($_POST['username']);
$password = trim($_POST['password']);

//Checking if username/password is blank - Callum
if (empty($studentNumber) || empty($password)) {
    echo "Username or Password is empty";
    exit();
}

//Connect to LoginController
$login = new LoginController($studentNumber, $password);

//Log in attempt
$login->login();
