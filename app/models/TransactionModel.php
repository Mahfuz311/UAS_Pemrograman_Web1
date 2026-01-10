<?php
class TransactionModel {
    private $conn;
    private $table = "transactions";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function create($userId, $productId, $price, $buyerName, $notes) {
        $query = "INSERT INTO " . $this->table . " (user_id, product_id, price, buyer_name, notes) VALUES (:uid, :pid, :price, :bname, :notes)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':uid', $userId);
        $stmt->bindParam(':pid', $productId);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':bname', $buyerName);
        $stmt->bindParam(':notes', $notes);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT t.id, t.created_at, t.price, t.buyer_name, t.notes, u.username, p.name as product_name, p.image 
                  FROM " . $this->table . " t
                  JOIN users u ON t.user_id = u.id
                  JOIN products p ON t.product_id = p.id
                  ORDER BY t.created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRevenue() {
        $query = "SELECT SUM(price) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ? $row['total'] : 0;
    }
    
    public function countTransactions() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function clearAll() {
        $query = "TRUNCATE TABLE " . $this->table;
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
}