<?php

//

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../classes/BasketController.php';

$productId = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? null;

$basketController = new BasketController();

$basketController->addItemToBasket($productId, $quantity);

header('Location:../../products.php?basketupdate='.$productId.'&'.$quantity); // Redirect to index for testing purposes



