<?php

$pageTitle = 'Basket';


session_start();

require __DIR__ . '/resources/classes/DatabaseHandler.php';
require __DIR__ . '/resources/classes/ProductController.php';

$productController = new ProductController();
$categories = $productController->getCategories();

$pageCategory = $_GET['category'] ?? null;

if ($pageCategory) {
    $allProducts = $productController->getProductByCategory($pageCategory);
} else {
    $allProducts = $productController->getAllProducts();
}


$productsById = [];
foreach ($allProducts as $product) {
    $productsById[$product->product_id] = $product;
}

include __DIR__ . '/resources/views/header.php';


?>

<div class="columns is-flex is-flex-grow-1">
    <div class="column is-two-thirds is-offset-2">
        <section class="section is-medium">
            <div class="box">
                <form action="resources/handlers/basket.handler.php" method="post">
                    <table class="table is-fullwidth is-striped is-hoverable">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>

                        <tbody>

                        <?php if(empty($_SESSION['user']['basket']['items'])): ?>

                            <tr>
                                <td class="has-text-centered" colspan="5"><h1 class="subtitle is-4">Nothing in basket...</h1></td>
                            </tr>

                        <?php endif; ?>
                        <?php
                        foreach ($_SESSION['user']['basket']['items'] as $id => $item): ?>


                            <tr>
                                <td>
                                    <figure class="image is-96x96">
                                        <img class="is-rounded" src="resources/images/placeholder.svg">
                                    </figure>
                                </td>
                                <td class="is-size-5"><?= $productsById[$id]->name ?></td>
                                <td>
                                    <div class="control">
                                        <input
                                            class="input is-normal is-rounded"
                                            type="number"
                                            name="quantity[<?= $id ?>]"
                                            min="0"
                                            max="<?= $productsById[$id]->stock ?>"
                                            value="<?= $item['quantity'] ?>">
                                        <input type="hidden" name="add_product_id" value="<?= $id ?>">
                                    </div>
                                </td>
                                <td>£<?= $item['total'] ?></td>
                                <td>
                                    <input type="hidden" name="remove_product_id" value="<?= $id ?>">
                                    <button
                                        class="button is-danger"
                                        type="submit"
                                        name="action"
                                        value="remove"
                                        >
                                    <span class="icon has-text-danger-light">
                                    <i class="fas fa-trash-can fa-lg"></i>
                                    </span>
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="is-size-4 has-text-right" colspan="4">Total:</th>
                            <td class="is-size-4">£<?= $_SESSION['user']['basket']['total'] ?></td>
                        </tr>
                        </tfoot>

                    </table>
                    <div class="buttons">
                        <div class="control">
                            <button class="button is-info" type="submit" name="action" value="update">Update Basket
                            </button>
                        </div>
                        <div class="control">
                            <button class="button is-success" type="submit" name="action" value="order">Place Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<?php include __DIR__ . '/resources/views/footer.html'; ?>



