<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../classes/DatabaseHandler.php';
require_once __DIR__ . '/../classes/ProductController.php';
require_once __DIR__ . '/../classes/BasketController.php';
require_once __DIR__ . '/../classes/OrderController.php';


$action = $_POST["action"] ?? null;
$productController =  new ProductController();
$basketController = new BasketController($productController);

if($action == "remove"){
    $basketController->removeFromBasket($_POST["remove_product_id"]);
    header("location: ../../basket.php?removed=".$_POST["remove_product_id"]);
}

if ($action == "update") {
    if(!empty($basketController->getBasketItems())) {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity > 0) {
                $basketController->updateBasketItem($id, $quantity);
                header('Location: ../../basket.php?updated=1');
            } else {
                $basketController->removeFromBasket($id);
                header('Location: ../../products.php?basket=updated');
            }
        }
    } else {
        header('Location: ../../basket.php?updated=0');
    }

}

if ($action == "add") {
    $productId = $_POST['add_product_id'];
    $quantity = $_POST['add_quantity'];
    $basketController->addItemToBasket($productId, $quantity);
    header('Location: ../../products.php?added='.$productId);
}

if ($action == "order") {
    $uid = $_SESSION['user']['uid'] ?? null;
    if(!empty($basketController->getBasketItems())) {
        if ($uid) {
            $orderController = new OrderController();
            $basket = $basketController->getBasketItems();
            $total = $basketController->getTotal();

            $orderId = $orderController->createOrder($uid, $basket, $total);
            if ($orderId) {
                $basketController->clearBasket();
                header('Location: ../../account.php?ordersuccess='.$orderId);
            } else {
                echo 'Order failed';
            }
        } else {
            header('Location: ../../login.html?error=notloggedin');
        }
    } else {
        header('Location: ../../basket.php?orderfail=basketempty');
    }


}



// header('Location:../../products.php?basketupdate='.$productId.'&'.$quantity); // Redirect to index for testing purposes



