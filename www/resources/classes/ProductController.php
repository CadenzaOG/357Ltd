<?php

/*
* Author: Sean Boa
* Date: April 2026
*/



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

    public function getProductPrice($id) {
        $stmt = $this->pdo->prepare("SELECT price FROM product WHERE product_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $price = $stmt->fetch();
        return $price;
    }

    function getProductByCategory($categoryId) {
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE category_id = :id");
        $stmt->bindParam(":id", $categoryId);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    function getCategories() {
        $stmt = $this->pdo->prepare("SELECT category_id, description FROM category");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_UNIQUE);
        return $categories;
    }


}