<?php

session_start();

$username = '';
$password = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}

// Temporary hard coded login values.  Check with Database here and redirect user.

if ($username === 'admin' && $password === 'password') {
    echo 'Welcome!';
} else {
    echo 'You can\'t come in';
}