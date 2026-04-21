<?php

session_start();

if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['forename'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>Hello,world</h1>
<h1><?= $name ?></h1> <!-- printing name to test session variables have been set -->
</body>
</html>