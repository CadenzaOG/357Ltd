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
            header('Location: ../../products.php?basket=updated');
        } else {
            $basketController->removeFromBasket($id);
            header('Location: ../../products.php?basket=updated');
        }
    }
}

if ($action == "add") {
    $productId = $_POST['add_product_id'];
    $quantity = $_POST['add_quantity'];
    $basketController->addItemToBasket($productId, $quantity);
    header('Location: ../../products.php?basket=updated');
}



// header('Location:../../products.php?basketupdate='.$productId.'&'.$quantity); // Redirect to index for testing purposes



