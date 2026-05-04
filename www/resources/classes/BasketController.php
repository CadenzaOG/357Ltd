<?php

class BasketController
{

    private $basket;

    public function __construct()
    {
        $this->basket = &$_SESSION['user']['basket'];
    }

    public function addItemToBasket($productId, $quantity) {
        if (isset($this->basket[$productId]['quantity'])) {
            $this->basket[$productId]['quantity'] += $quantity;
        } else {
            $this->basket[$productId]['quantity'] = $quantity;
        }
    }

    public function updateBasketItem($productId, $quantity) {
        $this->basket[$productId]['quantity'] = $quantity;
    }

    public function removeFromBasket($productId) {
        unset($this->basket[$productId]);
    }

}