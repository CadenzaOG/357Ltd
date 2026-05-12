<?php



//

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

if ($action == "order") {
    $uid = $_SESSION['user']['uid'] ?? null;
    if ($uid) {
        $orderController = new OrderController();
        $basket = $basketController->getBasketItems();

        $orderId = $orderController->createOrder($uid, $basket);
        if ($orderId) {
            echo 'Order Successfully created for User: ' . $_SESSION['user']['name'] . ' -- Order ID: ' . $orderId;
        } else {
            echo 'Order failed';
        }



    } else {
        header('Location: ../../login.html?error=notloggedin');
    }

}



// header('Location:../../products.php?basketupdate='.$productId.'&'.$quantity); // Redirect to index for testing purposes



