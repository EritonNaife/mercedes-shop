<?php
// Template for rendering the shopping cart page for Mercedes Shop

// Renders cart container with items and summary
// @param array $cartItems Array of cart items with name, price, quantity, image_url
// @param float $subtotal Total cost of items
function drawCartContainer($cartItems, $subtotal, $tax, $total) {
    ob_start(); ?>
    <section class="cart-container">
        <div class="cart-header">
            <h1>Your Shopping Cart</h1>
            <p class="cart-count"><?= count($cartItems) ?> items</p>
        </div>
        <div class="cart-content">
            <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        </div>
                        <div class="item-details">
                            <h3><?= htmlspecialchars($item['name']) ?></h3>
                            <p class="item-price">$<?= number_format($item['price'], 2) ?></p>
                            <form action="/actions/action_update_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="10">
                                <button type="submit">Update</button>
                            </form>
                            <form action="/actions/action_remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="cart-summary">
                <h2>Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$<?= number_format($subtotal, 2) ?></span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span>$<?= number_format($tax, 2) ?></span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>$<?= number_format($total, 2) ?></span>
                </div>
                <a href="/pages/checkout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        </div>
    </section>
    <?php return ob_get_clean();
}
?>