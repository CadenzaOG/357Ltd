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

<style>
    table,th,td {
        border: 1px solid;
    }
</style>
<h1>All Products</h1>
<table style="border: 1px solid">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Available Stock</th>
        <th>Quantity</th>
        <th></th>
    </tr>
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
<button type="submit" name="action" value="update">Update Basket</button>
</form>
