<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
</head>
<body>

<table>
    <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Order Time</th>
        <th>Shipped</th>
        <th>Cancel</th>
    </tr>


<?php

require __DIR__ . '/resources/includes/account.include.php';


foreach ($orders as $order) : ?>

    <tr>
        <td><?=$order->order_id?></td>
        <th><?=$order->order_date?></th>
        <th><?=$order->order_time?></th>
        <th><?= $order->shipped ? 'Awaiting Shipment' : 'Shipped'?></th>
        <th><button>Cancel Order</button></th>
    </tr>

    <?php endforeach; ?>
</table>
</body>
</html>