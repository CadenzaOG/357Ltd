<?php


if (!isset($_SESSION['user']['uid'])) {
    header ("Location: login.php");
}

require_once __DIR__ . '/../classes/DatabaseHandler.php';
require_once __DIR__ . '/../classes/ProductController.php';
require_once __DIR__ . '/../classes/BasketController.php';
require_once __DIR__ . '/../classes/OrderController.php';

$ordersController = new OrderController();
$productController = new ProductController();

$orders = $ordersController->getOrders($_SESSION['user']['uid']);





