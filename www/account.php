<?php

/*
* Author: Sean Boa
* Date: May 2026
*/


$pageTitle = 'Order History';

include "resources/views/header.php";

require __DIR__ . '/resources/includes/account.include.php';

$orderSuccess = $_GET['ordersuccess'] ?? null;
$orderCancelled = $_GET['ordercancelled'] ?? null;



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

<?php if($orderSuccess): ?>

<div class="column is-3 is-offset-4">
    <div class="notification is-info is-light has-text-centered">
        <button class="delete"></button>
        Order successfully placed.  Order ID: <?= $orderSuccess ?>
    </div>
</div>

<?php elseif ($orderCancelled): ?>

<div class="column is-3 is-offset-4">
    <div class="notification is-danger is-light has-text-centered">
        <button class="delete"></button>
        Order successfully cancelled.  Order ID: <?= $orderCancelled ?>
    </div>
</div>

<?php endif; ?>



<section class="section">
    <div class="container">
        <h1 class="title">Order History</h1>
        <?php if(!$orders): ?>
        <p class="subtitle">No orders to display</p>
        <?php else: ?>
        <p class="subtitle">View and manage your orders</p>
        <table class="table is-fullwidth is-striped is-hoverable">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Total</th>
                <th>Status</th>
                <th>Cancel</th>
            </tr>
            </thead>

            <tbody>



            <?php foreach ($orders as $order) : ?>

            <?php $status = $order->shipped;

            $tag = '';

            switch ($status) {
                case '0': $tag = 'is-warning'; break;
                case '1': $tag = 'is-success'; break;
                case '2': $tag = 'is-danger'; break;
            }

            ?>

                <tr>
                    <td><?=$order->order_id?></td>
                    <td><?=$order->order_date?></td>
                    <td><?=$order->order_time?></td>
                    <td>£<?=$order->order_total?></td>
                    <td><span class="tag <?=$tag?>">
                            <?php if($status == '0'): ?>
                            Awaiting Shipment
                            <?php elseif($status == '1'): ?>
                            Delivered
                            <?php elseif($status == '2'): ?>
                            Cancelled
                            <?php endif; ?>
                        </span></td>
                    <td>
                        <?php if(!$order->shipped) : ?>
                        <form action="resources/handlers/order.handler.php"
                              method="post"
                              >
                            <input type="hidden" name="orderId" value="<?=$order->order_id?>">
                        <button class="button is-danger is-small"
                        type="submit"
                        name="action"
                        value="cancelOrder">
                            <span class="icon">
                                <i class="fas fa-ban"></i>
                            </span>
                            <span>Cancel Order</span>
                        </button>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>


            </tbody>
        </table>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/resources/views/footer.html'; ?>
