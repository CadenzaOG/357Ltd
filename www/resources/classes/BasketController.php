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
        if (isset($this->basket[$productId]['quantity'])) {
            $this->basket[$productId]['quantity'] += $quantity;
        } else {
            $this->basket[$productId]['quantity'] = $quantity;
        }
        $this->updateTotal();
    }


    public function updateBasketItem($productId, $quantity) {
        $this->basket[$productId]['quantity'] = $quantity;
        $this->updateTotal();
    }

    public function removeFromBasket($productId) {
        unset($this->basket[$productId]);
        $this->updateTotal();
    }

    private function updateTotal() {
        $total=0;
        foreach ($this->basket as $id => $item) {
            $price = $this->productController->getProductPrice($id);
            $productTotal = $price * $item['quantity'];
            $this->basket[$id]['total'] = $productTotal;
            $total += $productTotal;
        }
        $this->basket['total'] = $total;
    }


}