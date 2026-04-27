<?php

require __DIR__ . '/resources/classes/DatabaseHandler.php';
require __DIR__ . '/resources/classes/ProductController.php';

$productController = new ProductController();

$allProducts = $productController->getAllProducts();

?>
<h1>All Products</h1>
<ul>
    <?php foreach ($allProducts as $product): ?>
    <li>Name: <?= $product->name . ' | Description:' . $product->description . ' | Price: £' . $product->price . ' | Stock' . $product->stock ?></li>
</ul>
<?php endforeach; ?>
// Test file for printing products
