<?php

session_start();

$uri = $_SERVER['HTTP_REFERER'];

if (isset($_SESSION['user']['uid'])) {
    unset($_SESSION['user']['uid']);
    header("Location: " . $uri);
} else {
    header("Location: ../../index.php");
}


