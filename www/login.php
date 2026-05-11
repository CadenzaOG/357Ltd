<?php

//Get username & password without any spaces before/after
$username = trim($_POST['username']);
$password = trim($_POST['password']);

//Checking if username/password is blank
if (empty($username) || empty($password)) {
    echo "Username or Password is empty";
}

//Checking if username/password are in the database
if (username === $validUsername && $password === $validPassword) {
    session.start();
} else {
    echo "Invalid username or password";
}

