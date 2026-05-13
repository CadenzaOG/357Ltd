<?php

session_start();

require __DIR__ . '/resources/classes/DatabaseHandler.php';
require __DIR__ . '/resources/classes/ProductController.php';

$productController = new ProductController();

$allProducts = $productController->getAllProducts();

$productsById = [];
foreach ($allProducts as $product) {
    $productsById[$product->product_id] = $product;
}
?>

<!DOCTYPE html>
<html data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>

    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css"
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            <strong>357ltd</strong>
        </a>
    </div>

    <div name="navbarBasic" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Home
            </a>
            <a class="navbar-item" href="products.php">
                Products
            </a>
            <a class="navbar-item" href="account.php">
                Account
            </a>
        </div>
    </div>

    <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
                <a class="button is-large" href="basket.php">
                    <span class="icon">
                        <i class="fas fa-basket-shopping"></i>
                    </span>
                </a>
                <a class="button is-light" href="resources/handlers/logout.php">
                    Logout
                </a>
            </div>
        </div>
    </div>

</nav>


<h1>All Products</h1>
<table style="border: 1px solid">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Available Stock</th>
        <th>Quantity</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($allProducts as $product): ?>
        <form action="resources/handlers/basket.handler.php" method="post">
        <tr>
                <td><?= htmlspecialchars($product->name) ?></td>
                <td><?= htmlspecialchars($product->description) ?></td>
                <td>£<?= htmlspecialchars($product->price) ?></td>
                <td><?= htmlspecialchars($product->stock) ?></td>
                <td>
                    <input type="number" name="add_quantity" value="1" min="1" max="<?= $product->stock ?>">
                    <input type="hidden" name="add_product_id" value="<?= $product->product_id ?>">
                </td>
                <td>
                    <button type="submit" name="action" value="add">Add to Basket</button>
                </td>

        </tr>
        </form>
    <?php endforeach; ?>
    </tbody>
</table>

<h1>Basket</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
        <?php
        foreach ($_SESSION['user']['basket']['items'] as $id => $item): ?>
        <form action="resources/handlers/basket.handler.php" method="post">
    <tr>
        <td><?= $productsById[$id]->name?></td>
        <td><input type="number" name="quantity[<?=$id?>]" min="0" max="<?=$productsById[$id]->stock ?>" value="<?=$item['quantity']?>"></td>
        <td>£<?=$item['total']?></td>
    </tr>
        <?php endforeach; ?>
            <tr>
                <th>Total: </th>
                <td colspan="2">£<?=$_SESSION['user']['basket']['total']?></td>
            </tr>
</table>
<button type="submit" name="action" value="update">Update Basket</button><button type="submit" name="action" value="order">Order</button>
</form>
</body>
</html>
