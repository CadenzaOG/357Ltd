<?php

class ProductController extends DatabaseHandler
{
    private $pdo;

    function __construct() {
        $this->pdo = $this->connect();
    }
    function getAllProducts() {
        $stmt = $this->pdo->prepare("SELECT * FROM product");
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    function getProductById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE product_id = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $product = $stmt->fetch();

        return $product;
    }

    function getProductByCategory($categoryId) {
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE category_id = :id");
        $stmt->bindParam(":id", $categoryId);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
}