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

<head>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            padding: 30px;
        }

        /* Headings */
        h1 {
            margin-bottom: 15px;
            color: #222;
        }

        /* Tables */
        table {
            border-collapse: collapse;
            margin-bottom: 30px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #4a90e2;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9fbfd;
        }

        tr:hover {
            background-color: #eef4ff;
        }

        /* Inputs */
        input[type="number"] {
            width: 70px;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Buttons */
        button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            background-color: #4a90e2;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        button:hover {
            background-color: #357abd;
        }

        /* Total row */
        th[colspan] {
            text-align: right;
        }</style>


</head>



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
<button type="submit" name="action" value="update">Update Basket</button><button type="submit" name="action" value="order">Order</button>
</form>
