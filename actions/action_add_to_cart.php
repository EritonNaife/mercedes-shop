<?php
session_start();

// Check if product ID is provided
if (!isset($_POST['product_id'])) {
    header('Location: /index.php');
    exit();
}

$productId = $_POST['product_id'];

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart (or increase quantity if already exists)
if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId] += 1;
} else {
    $_SESSION['cart'][$productId] = 1;
}

// Redirect back to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>