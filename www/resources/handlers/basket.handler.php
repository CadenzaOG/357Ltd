<?php

//

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../classes/BasketController.php';

$action = $_POST["action"] ?? null;
$basketController = new BasketController();

if ($action == "update") {
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity > 0) {
            $basketController->updateBasketItem($id, $quantity);
        } else {
            $basketController->removeFromBasket($id);
        }
    }
}

if ($action == "add") {
    $productId = $_POST['add']['product_id'];
    $quantity = $_POST['add']['quantity'];
    $basketController->addItemToBasket($productId, $quantity);
}



// header('Location:../../products.php?basketupdate='.$productId.'&'.$quantity); // Redirect to index for testing purposes



