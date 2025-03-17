<?php
require_once __DIR__ . '/connection.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = getDatabaseConnection();
    }
    
    // Create a new order
    public function create($userId,$total,$status,$shippingAddress,$city,$state,$zip,$country,$paymentMethod) {
        // Insert order
        $stmt = $this->db->prepare("
            INSERT INTO orders (user_id,total,status,shipping_address,shipping_city,shipping_state,shipping_zip,shipping_country,payment_method)
            VALUES (:user_id,:total,:status,:shipping_address,:shipping_city,:shipping_state,:shipping_zip,:shipping_country,:payment_method)
        ");
        $stmt->bindValue(':user_id', $userId, SQLITE3_INTEGER);
        $stmt->bindValue(':total', $total, SQLITE3_FLOAT);
        $stmt->bindValue(':shipping_address',$shippingAddress, SQLITE3_TEXT);
        $stmt->bindValue(':shipping_city',$city,SQLITE3_TEXT);
        $stmt->bindValue(':shipping_state',$state,SQLITE3_TEXT);
        $stmt->bindValue(':shipping_zip',$zip,SQLITE3_TEXT);
        $stmt->bindValue(':shipping_country',$country,SQLITE3_TEXT);
        $stmt->bindValue(':payment_method',$paymentMethod,SQLITE3_TEXT);
        $stmt->bindValue(':status',$status,SQLITE3_TEXT);
        $stmt->execute();
        $orderId = $this->db->lastInsertRowID();
        return $orderId;
    }

    public function addOrderItem($orderId,$productId,$quantity){
        $stmt = $this->db->prepare("
        INSERT INTO order_items (order_id, product_id, quantity)
        VALUES (:order_id,:product_id,:quantity)

        ");
        $stmt->bindValue(':order_id',$orderId,SQLITE3_INTEGER);
        $stmt->bindValue(':product_id',$productId,SQLITE3_INTEGER);
        $stmt->bindValue(':quantity',$quantity,SQLITE3_INTEGER);
        $stmt->execute();

    }
    // Get orders by user ID
    public function getByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT * FROM orders 
            WHERE user_id = :user_id 
            ORDER BY created_at DESC
        ");
        $stmt->bindValue(':user_id', $userId, SQLITE3_INTEGER);
        $result = $stmt->execute();

        $orders = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $orders[] = $row;
        }
        return $orders;
    }
    
    public function getById($orderId) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->bindValue(':id', $orderId, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }
    // Get order items by order ID
    public function getItems($orderId) {
        $stmt = $this->db->prepare("
            SELECT oi.quantity, p.name, p.price, p.image_url
            FROM order_items oi 
            JOIN products p ON oi.product_id = p.id 
            WHERE oi.order_id = :order_id
        ");
        $stmt->bindValue(':order_id', $orderId, SQLITE3_INTEGER);
        $result = $stmt->execute();

        $items = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $items[] = $row;
        }
        return $items;
    }
}
?>