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
                <a class="navbar-item" href="basket.php">
                    <span class="icon">
                        <i class="fas fa-cart-shopping fa-2x"></i>
                    </span>
                </a>
                <a class="button is-light" href="resources/handlers/logout.php">
                    Logout
                </a>
            </div>
        </div>
    </div>

</nav>



<section class="section">
    <div class="container">
        <h1 class="title">Order History</h1>
        <p class="subtitle">View and manage your orders</p>
        <table class="table is-fullwidth is-striped is-hoverable">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Order Time</th>
                <th>Shipped</th>
                <th>Cancel</th>
            </tr>
            </thead>

            <tbody>
            <?php

            require __DIR__ . '/resources/includes/account.include.php';


            foreach ($orders as $order) : ?>

                <tr>
                    <td><?=$order->order_id?></td>
                    <td><?=$order->order_date?></td>
                    <td><?=$order->order_time?></td>
                    <td><span class="tag <?= $order->shipped ? 'is-success' : 'is-warning'?>">
                        <?= $order->shipped ? 'Shipped' : 'Awaiting Shipment'?></span></td>
                    <td>
                        <?php if(!$order->shipped) : ?>
                        <a class="button is-danger">
                            <span class="icon">
                                <i class="fas fa-ban"></i>
                            </span>
                            <span>Cancel Order</span>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>

