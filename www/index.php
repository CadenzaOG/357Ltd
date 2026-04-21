<?php

session_start();

if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['name'];
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
<p>Testing deployment from github</p>
<p>Testing branch protection rule</p>
<h1><?= $name ?></h1>
</body>
</html>