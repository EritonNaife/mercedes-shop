<?php
// Renders the checkout page with multi-step form for Mercedes Shop

require_once __DIR__ . '/../templates/common.tpl.php';
require_once __DIR__ . '/../templates/checkout.tpl.php';
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/order.class.php';
require_once __DIR__ . '/../database/product.class.php';


$session = new Session();

// Redirect if not logged in
if (!$session->isLoggedIn()) {
    header('Location: /pages/login.php');
    exit();
}

// Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: /pages/cart.php');
    exit();
}

// Fetches cart items and calculates totals
$productDB = new Product();
$cartItems = [];
$subtotal = 0;

foreach($_SESSION['cart'] as $productID => $quantity){ // Fixed typo
    $productData = $productDB->getProductById($productID);
    
    if ($productData) {
        // Add quantity to product data
        $productData['quantity'] = $quantity; 
        $cartItems[] = $productData;
        
        // Calculate subtotal
        $subtotal += $productData['price'] * $quantity;
    }
}

// Sets default shipping and tax values for display
$shipping = floatval($_POST['shipping'] ?? 5.99);
$tax = $subtotal * 0.08;
$total = $subtotal + $shipping + $tax;

// Draw page
echo drawHeader("Checkout - Mercedes Shop");
echo drawCheckoutContainer($cartItems, $subtotal, $shipping, $tax, $total);
echo drawFooter();
?>