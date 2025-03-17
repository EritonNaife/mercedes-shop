<?php
// Template for rendering common UI elements (header and footer) across Mercedes Shop pages

// Renders the site header with logo, navigation, and cart link
// @param string $title Site title, defaults to "Mercedes Shop"
// @return string HTML content of the header
function drawHeader($title = "Mercedes Shop") {
    ob_start(); ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400&family=Raleway:wght@400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="/css/account.css">
        <link rel="stylesheet" href="/css/featured.css">
        <link rel="stylesheet" href="/css/cart.css">
        <link rel="stylesheet" href="/css/order.css">
        <link rel="stylesheet" href="/css/checkout.css">
        <link rel="stylesheet" href="/css/product.css">
        
        <title><?= htmlspecialchars($title) ?></title>
    </head>
    <body>
        <header>
            <nav class="main-nav">     
                <div class="top-row">
                    <a href="/pages/index.php" class="logo">Mercedes Shop</a>
                    <div class="nav-tools">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="/actions/action_logout.php" class="account-icon">Logout</a>
                        <?php else: ?>
                            <a href="/pages/login.php" class="account-icon">Login</a>
                        <?php endif; ?>
                        <a href="/pages/cart.php" class="cart-icon">
                            Cart (<span class="cart-count"><?= array_sum($_SESSION['cart'] ?? []) ?></span>)
                        </a>
                    </div>
                </div>
                <input type="checkbox" id="menu-toggle" class="menu-toggle">
                <label for="menu-toggle" class="menu-icon">☰</label>
                <div class="nav-links">
                    <a href="#">Skin</a>
                    <a href="">Bath & Showers</a>
                    <a href="/about">About Us</a>
                </div>
            </nav>
        </header>
        <main>
        <script src="/js/nav.js"></script>
    <?php return ob_get_clean();
}

function drawFooter() {
    ob_start(); ?>
        </main>
        <footer>
            <div class="footer-logo">
                <img src="/images/logo.png" alt="Mercedes Shop Logo">
                <p>© 2025 Mercedes Shop. All rights reserved.</p>
            </div>
            <div class="products">
                <h4>Products</h4>
                <a href="/products/skin">Skin</a>
                <a href="/products/bath-shower">Shower & Bath</a>
                <a href="/products/gift-sets">Gift Sets</a>
                <a href="/products/new">New Arrivals</a>
            </div>
            <div class="contact">
                <h4>Contact Us</h4>
                <p>Email: info@mercedesshop.com</p>
                <p>Phone: (555) 123-4567</p>
                <div class="social-icons">
                    <a href="#">Facebook</a>
                    <a href="#">Instagram</a>
                    <a href="#">Twitter</a>
                </div>
            </div>
            <div class="subscribe">
                <h4>Subscribe</h4>
                <p>Stay updated with our latest products and offers</p>
                <div class="subscribe-form">
                    <form action="/actions/action_subscribe.php" method="POST">
                        <input type="email" name="email" placeholder="Your Email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </footer>
    </body>
    </html>
    <?php return ob_get_clean();
}
?>