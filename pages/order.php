<?php
require_once __DIR__ . '/../templates/common.tpl.php';
require_once __DIR__ . '/../templates/order.tpl.php';
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/order.class.php';

$session = new Session();
$orderDB = new Order();

$orderId = $_GET['id'] ?? null;
$order = $orderDB->getById($orderId);
if (!$order) header('Location: /pages/index.php');
$orderItems = $orderDB->getItems($order['id']);

// Draw page
echo drawHeader("Order Confirmation | Mercedes Shop");
echo drawOrderConfirmation($order, $orderItems);
echo drawFooter();
?>