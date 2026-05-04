<?php

// Placeholder index page, just using for testing backend and outputting database/session information.

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
<?php
if (isset($_SESSION['user'])): ?>
    <h1>Hello, <?= $name ?></h1>
<?php else: ?>
    <h1>Hello, world</h1>
<?php endif; ?>
<ul>
<li><a href="login.html">Login</a></li>
<li><a href="signup.html">Sign up</a></li>
<li><a href="products.php">Products</a></li>
</ul>
<br><br>
</body>
</html>
