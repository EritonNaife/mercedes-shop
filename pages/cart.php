<?php
// Displays the user's shopping cart with items and summary in Mercedes Shop
require_once __DIR__ . '/../templates/common.tpl.php';
require_once __DIR__ . '/../templates/cart.tpl.php';
require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/../database/product.class.php';

// Start session
session_start();

//if Iniatilize cart if it doesn't exist
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

$productService = new Product();
$cartItems = [];
$subtotal = 0;

foreach($_SESSION['cart'] as $productID => $quantity){ 
    $productData = $productService->getProductById($productID);
    
    if ($productData) {
        // Add quantity to product data
        $productData['quantity'] = $quantity; 
        $cartItems[] = $productData;
        
        // Calculate subtotal
        $subtotal += $productData['price'] * $quantity;
    }
}

$tax = $subtotal * 0.08;
$total = $subtotal + $tax;

// Renders cart page with items and subtotal
echo drawHeader("Shopping Cart - Mercedes Shop");
echo drawCartContainer($cartItems, $subtotal, $tax, $total);
echo drawFooter();
?>