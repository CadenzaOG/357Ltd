/*
* Author: Sean Boa
* Date: May 2026
*/

<?php

class OrderController extends DatabaseHandler
{
    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    public function getOrder($uid, $orderId) {
        $stmt = $this->pdo->prepare("SELECT * FROM `customer_order` WHERE `customer_id` = :uid AND `order_id` = :orderId");

        $stmt->bindParam(":uid", $uid);
        $stmt->bindParam(":orderId", $orderId);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function getOrderProducts($uid, $orderId, $productController) {

        $products = [];

        $stmt = $this->pdo->prepare("SELECT * FROM `order_product` WHERE `customer_id` = :uid AND `order_id` = :orderId");

        // Function to be finished

        return $products;
    }

    public function shipOrder($user, $orderId) {
        if ($user->isAdmin()) {

            $stmt = $this->pdo->prepare("UPDATE `customer_order` SET `shipped` = TRUE WHERE `order_id` = :orderId");
            $stmt->bindParam(":orderId", $orderId);

            if ($stmt->execute()) {
                return true;
            }
        }

        return false;
    }

    public function cancelOrder($uid, $orderId) {

        $this->pdo->beginTransaction();

        $productStmt = $this->pdo->prepare("DELETE FROM `order_product` WHERE `order_id` = :orderId");

        $productStmt->bindParam(":orderId", $orderId);

        $productStmt->execute();

        if ($productStmt->rowCount() === 0) {
            $this->pdo->rollBack();
            return false;
        }

        $orderStmt = $this->pdo->prepare("DELETE FROM `customer_order` WHERE `order_id` = :orderId AND `shipped` = FALSE");

        $orderStmt->bindParam(":orderId", $orderId);

        $orderStmt->execute();

        if ($orderStmt->rowCount() === 0) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function createOrder($uid, $basket) {

        try {
            $this->pdo->beginTransaction();

            $orderStmt = $this->pdo->prepare('INSERT INTO customer_order(`customer_id`, `order_date`, `order_time`, `shipped`) 
                                                    VALUES (:customer_id, CURRENT_DATE, CURRENT_TIME, FALSE)');

            $orderStmt->bindParam(':customer_id', $uid);

            $orderId = $this->pdo->lastInsertId();

            $orderProductStmt = $this->pdo->prepare('INSERT INTO order_product(`order_id`, `product_id`, `quantity`)');

            foreach ($basket as $productId => $product) {


                $orderProductStmt->bindParam(':product_id', $productId);
                $orderProductStmt->bindParam(':order_id', $orderId);
                $orderProductStmt->bindParam(':quantity', $product['quantity']);

                $orderProductStmt->execute();

                $productStmt = $this->pdo->prepare('UPDATE product SET stock = stock - :quantity WHERE product_id = :id AND stock >= :quantity');
                $productStmt->bindParam(':quantity', $product['quantity']);
                $productStmt->bindParam(':id', $productId);

                $productStmt->execute();

                if ($productStmt->rowCount() === 0) {
                    $this->pdo->rollBack();
                    $_SESSION['errors'][$productId] = "Insufficient Stock for product ID: " . $productId;
                    return false;
                }

                }
                $this->pdo->commit();
                return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

}