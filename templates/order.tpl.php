<?php
// Template for rendering order confirmation page for Mercedes Shop

// Renders order confirmation details
// @param array $order Order data with id, total, status, shipping details
// @param array $orderItems Array of items in the order

function drawOrderConfirmation($order, $orderItems) {
    ob_start(); ?>
    <section class="order-confirmation">
        <h1>Thank You For Your Order!</h1>
        <div class="confirmation-details">
            <h2>Order Details</h2>
            <p><strong>Order #</strong> <?= $order['id'] ?? 'N/A' ?></p>
            <p><strong>Status:</strong> <?=htmlspecialchars($order['status'] ?? 'Unknown') ?></p>
            
            <h2>Order Summary</h2>
            <div class="order-items">
                <?php foreach ($orderItems as $item) { ?>
                    <div class="order-item">
                        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Unknown Item') ?>">
                        <p><?= htmlspecialchars($item['name'] ?? 'Unknown Item') ?></p>
                        <p>Qty: <?= $item['quantity'] ?? 0 ?></p>
                        <p>$<?= number_format($item['price'] ?? 0, 2) ?></p>
                    </div>
                <?php } ?>
            </div>
            
            <div class="order-totals">
                <p>Subtotal: $<?= number_format(($order['total'] ?? 0) - 5.99, 2) ?></p>
                <p>Shipping: $5.99</p>
                <p>Tax: $<?= number_format((($order['total'] ?? 0) - 5.99) * 0.08, 2) ?></p>
                <p><strong>Total: $<?= number_format($order['total'] ?? 0, 2) ?></strong></p>
            </div>
            
            <h2>Shipping Address</h2>
            <p><?= htmlspecialchars($order['shipping_address'] ?? 'Not provided') ?></p>
            
            <h2>Payment Method</h2>
            <p><?= htmlspecialchars($order['payment_method'] ?? 'Not provided') ?></p>
        </div>
    </section>
    <?php
    return ob_get_clean();
}