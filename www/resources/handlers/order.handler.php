<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uid = $_SESSION["user"]["uid"] ?? null;

if(!$uid) {
    header("Location: ../../login.html");
}


require_once __DIR__ . '/../classes/DatabaseHandler.php';
require_once __DIR__ . '/../classes/ProductController.php';
require_once __DIR__ . '/../classes/BasketController.php';
require_once __DIR__ . '/../classes/OrderController.php';

$orderController = new OrderController();

$action = $_POST["action"] ?? null;
$orderId = $_POST["orderId"] ?? null;

if($action == "cancelOrder") {
    if ($orderController->cancelOrder($uid, $orderId)) {
        header("Location: ../../account.php?ordercancelled=".$orderId);
        exit;
    }
}