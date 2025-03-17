<?php
// Updates the quantity of a product in the user's shopping cart

session_start();

// Updates cart if quantity
$productId = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);
if ($quantity > 0) $_SESSION['cart'][$productId] = $quantity;


header('Location: /pages/cart.php');
exit();
?>