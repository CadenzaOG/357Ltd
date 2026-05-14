

<?php

/*
* Author: Sean Boa
* Date: May 2026
*/


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class OrderController extends DatabaseHandler
{
    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    public function getOrders($uid) {
        $stmt = $this->pdo->prepare("SELECT * FROM `customer_order` WHERE `customer_id` = :uid");
        $stmt->bindParam(':uid', $uid);
        $stmt->execute();

        $result = $stmt->fetchAll();

        if (empty($result)) {
            return false;
        }
        return $result;
    }

    public function getOrder($uid, $orderId) {
        $stmt = $this->pdo->prepare("SELECT * FROM `customer_order` WHERE `customer_id` = :uid AND `order_id` = :orderId");

        $stmt->bindParam(":uid", $uid);
        $stmt->bindParam(":orderId", $orderId);

        $stmt->execute();

        $order = $stmt->fetch();

        $orderProducts = $this->getOrderProducts($orderId);

        $result['order'] = $order;
        $result['orderProducts'] = $orderProducts;

        return $result;
    }

    public function getOrderProducts($uid, $orderId) {

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `order_product` WHERE `customer_id` = :uid AND `order_id` = :orderId");

            $stmt->bindParam(":uid", $uid);
            $stmt->bindParam(":orderId", $orderId);

            $stmt->execute();

            $products = $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $products;
    }

    // May not use -- planned for admin panel
    public function shipOrder($user, $orderId) {
        if ($user->is_admin === 1) {
            $stmt = $this->pdo->prepare("UPDATE `customer_order` SET `shipped` = TRUE WHERE `order_id` = :orderId");
            $stmt->bindParam(":orderId", $orderId);

            if ($stmt->execute()) {
                return true;
            }
        }

        return false;
    }


    public function cancelOrder($uid, $orderId) {

        try {
        $this->pdo->beginTransaction();

        $products = $this->getOrderProducts($uid, $orderId);

        $productStmt = $this->pdo->prepare("UPDATE `product` SET `stock` = `stock` + :quantity WHERE `product_id` = :productId");

        foreach ($products as $product) {
            $productStmt->bindParam(":quantity", $product->quantity);
            $productStmt->bindParam(":productId", $product->product_id);
            $productStmt->execute();

            if ($productStmt->rowCount() === 0) {
                $this->pdo->rollBack();
                return false;
            }
        }

        $orderStmt = $this->pdo->prepare("UPDATE `customer_order` SET `shipped` = 2 WHERE `order_id` = :orderId");
        $orderStmt->bindParam(":orderId", $orderId);
        $orderStmt->execute();

        if ($orderStmt->rowCount() === 0) {
            $this->pdo->rollBack();
            return false;
        }

        $this->pdo->commit();
        return true;


        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

//    public function deleteOrder($uid, $orderId) {
//
//        $this->pdo->beginTransaction();
//
//        $productStmt = $this->pdo->prepare("DELETE FROM `order_product` WHERE `order_id` = :orderId");
//
//        $productStmt->bindParam(":orderId", $orderId);
//
//        $productStmt->execute();
//
//        if ($productStmt->rowCount() === 0) {
//            $this->pdo->rollBack();
//            return false;
//        }
//
//        $orderStmt = $this->pdo->prepare("DELETE FROM `customer_order` WHERE `order_id` = :orderId AND `shipped` = FALSE");
//
//        $orderStmt->bindParam(":orderId", $orderId);
//
//        $orderStmt->execute();
//
//        if ($orderStmt->rowCount() === 0) {
//            $this->pdo->rollBack();
//            return false;
//        }
//    }

    public function createOrder($uid, $basket,$total) {

        try {
            $this->pdo->beginTransaction();

            $orderStmt = $this->pdo->prepare('INSERT INTO customer_order(`customer_id`, `order_date`, `order_time`, `order_total`, `shipped`) 
                                                    VALUES (:customer_id, CURRENT_DATE, CURRENT_TIME,:total, FALSE)');

            $orderStmt->bindParam(':customer_id', $uid);
            $orderStmt->bindParam(':total', $total);

            $orderStmt->execute();

            $orderId = $this->pdo->lastInsertId();

            $orderProductStmt = $this->pdo->prepare('INSERT INTO order_product(`order_id`, `product_id`, `quantity`) 
                                                            VALUES (:order_id, :product_id, :quantity)');

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
                return $orderId;

        } catch (PDOException $e) {

            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            echo $e->getMessage();
            $this->pdo->rollBack();
            return false;
        }
    }

}