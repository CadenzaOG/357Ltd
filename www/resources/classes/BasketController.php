
/*
* Author: Sean Boa
* Date: April 2026
*/

<?php

class BasketController
{

    private $basket;
    private $productController;

    public function __construct($productController) {
        $this->basket = &$_SESSION['user']['basket'];
        $this->productController = $productController;
    }

    public function addItemToBasket($productId, $quantity) {
        if (isset($this->basket['items'][$productId]['quantity'])) {
            $this->basket['items'][$productId]['quantity'] += $quantity;
        } else {
            $this->basket['items'][$productId]['quantity'] = $quantity;
        }
        $this->updateTotal();
    }


    public function updateBasketItem($productId, $quantity) {
        $this->basket['items'][$productId]['quantity'] = $quantity;
        $this->updateTotal();
    }

    public function removeFromBasket($productId) {
        unset($this->basket['items'][$productId]);
        $this->updateTotal();
    }

    private function updateTotal() {
        $total=0;
        foreach ($this->basket['items'] as $id => $item) {
            $product = $this->productController->getProductById($id);
            $price = $product->price;
            $productTotal = $price * $item['quantity'];
            $this->basket['items'][$id]['total'] = $productTotal;
            $total += $productTotal;
        }
        $this->basket['total'] = $total;
    }


}
