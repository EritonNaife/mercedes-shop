<?php
// Removes a specific product from the user's shopping cart
require_once __DIR__ . '/../utils/session.php';

$session = new Session();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets product ID to remove
    $productId = intval($_POST['product_id']);

    // Removes product from cart if it exists
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    // Redirects back to cart page
    header('Location: /pages/cart.php');
    exit();
}

// Redirects to cart page if not a POST request
header('Location: /pages/cart.php');
exit();
?>