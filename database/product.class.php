<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = getDatabaseConnection();
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM products 
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function getFeaturedProducts(){
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY RANDOM() LIMIT 3");
        $result = $stmt->execute();

        $products = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $products[] = $row;
        }
        return $products;
    }
}
?>