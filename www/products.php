<?php

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

$basketSuccess = $_GET['added'] ?? null;

$productsById = [];
foreach ($allProducts as $product) {
    $productsById[$product->product_id] = $product;
}

$pageTitle = $pageCategory ? 'Products - ' . $categories[$pageCategory]->description : 'Products';

include __DIR__ . '/resources/views/header.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
            const $notification = $delete.parentNode;

            $delete.addEventListener('click', () => {
                $notification.parentNode.removeChild($notification);
            });
        });
    });
</script>

<?php if($basketSuccess): ?>

<div class="column is-4 is-offset-4">
<div class="notification is-info is-light has-text-centered">
    <button class="delete"></button>
    <?=$productsById[$basketSuccess]->name?> succesfully added to basket!
</div>
</div>

<?php endif; ?>

<div class="section">
    <div class="columns">

        <div class="column is-2">
            <div class="box">
                <div class="menu">
                    <p class="menu-label"><strong>Categories</strong></p>
                    <ul class="menu-list">

                        <li><a href="products.php?">
                                <strong>All Products</strong>
                            </a>
                        </li>

                        <?php foreach ($categories as $id => $category) : ?>

                        <li><a href="products.php?category=<?=$id?>">
                                <?=$category->description?>
                            </a>
                        </li>

                        <?php endforeach; ?>



                    </ul>
                </div>
            </div>
        </div>

        <div class="column">
            <?php if($pageCategory): ?>
                <h1 class="title">Products</h1>
                <p class="subtitle"><?=$categories[$pageCategory]->description?></p>
            <?php else: ?>
            <h1 class="title">All Products</h1>
            <?php endif; ?>
            <div class="section">

                <div class="columns is-multiline">

                    <?php foreach ($allProducts as $product): ?>

                        <div class="column is-3 is-flex">

                            <form action="resources/handlers/basket.handler.php" method="post" class="card is-flex is-flex-direction-column">
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="resources/images/placeholder.svg" alt="placeholder image">
                                    </figure>
                                </div>

                                <div class="card-content is-flex-grow-1">
                                    <h5 class="title is-5"><?= htmlspecialchars($product->name) ?></h5>
                                    <p class="subtitle is-5"><?= htmlspecialchars($product->description) ?></p>
                                </div>

                                <div class="card-content pt-0">
                                    <p class="is-size-4"><strong>
                                            £<?= $product->price ?>
                                        </strong></p>
                                </div>

                                <div class="card-footer">

                                    <div class="card-footer-item">
                                    <div class="field is-grouped is-justify-content-right">
                                        <div class="control">
                                            <input class="input is-normal is-primary"
                                                   type="number"
                                                   name="add_quantity"
                                                   value="1"
                                                   min="1"
                                                   max="<?= $product->stock ?>"
                                            >
                                        </div>
                                        <input type="hidden" name="add_product_id"
                                               value="<?= $product->product_id ?>">

                                        <div class="control">
                                            <button class="button is-primary is-normal" type="submit" name="action"
                                                    value="add">
                                                Add to Basket
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/resources/views/footer.html'; ?>
