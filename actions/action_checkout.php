<?php
// Processes checkout form submission and creates an order in the database
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/order.class.php';
require_once __DIR__ . '/../database/product.class.php';

$session = new Session();
$orderDB = new Order();
$productDB = new Product();

$requiredFields = [
    'email', 'phone', 'first-name', 'last-name', 'address', 'city',
    'state', 'zip', 'country', 'payment', 'shipping'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch cart items
    $cartItems = $_SESSION['cart'] ?? [];
    $subtotal = 0;

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $session->set('error', 'All required fields must be filled.');
            header('Location: /pages/checkout.php');
            exit();
        }
    }

    foreach ($cartItems as $productId => $quantity) {
        $product = $productDB->getProductById($productId);
        if ($product) {
            $subtotal += $product['price'] * $quantity;
        }
    }

    $tax = $subtotal * 0.08;
    $total = $subtotal + $tax;

    // Creates order
    $orderId = $orderDB->create($session->getUserId(), $total, $shippingAddress,'pending',$_POST['city'],$_POST['state'],$_POST['zip'],$_POST['country'],$_POST['payment']);

    // Adds each cart item to order_items table
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $orderDB->addOrderItem($orderId, $productId, $quantity);
    }
    // Clear cart
    $_SESSION['cart'] = [];

    // Redirect to order confirmation page
    header('Location: /pages/order.php?id=' . $orderId);
    exit();
}
?>