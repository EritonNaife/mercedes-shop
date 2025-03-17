<?php
require_once __DIR__ . '/../templates/common.tpl.php';
require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/../database/product.class.php';

// Start session
session_start();

// Get featured products
$db = getDatabaseConnection();
$product = new Product();
$featuredProducts = $product->getFeaturedProducts();

// Draw page
echo drawHeader("Mercedes Shop - Home");
?>
<?php
?>
<section id="featured-products">
    <h2>Featured Products</h2>
    <div class="content">
        <?php foreach ($featuredProducts as $product): ?>
            <div class="product-card">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p class="price">$<?= number_format($product['price'], 2) ?></p>
                <form action="/actions/action_add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
echo drawFooter();
?>