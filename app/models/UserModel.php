<?php
class UserModel {
    private $conn;
    private $table = "users";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY role ASC, username ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->conn->prepare($query);
        
        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':role', $data['role']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        if (!empty($data['password'])) {
            $query = "UPDATE " . $this->table . " SET username = :username, password = :password, role = :role WHERE id = :id";
            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            $query = "UPDATE " . $this->table . " SET username = :username, role = :role WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':id', $id);

        if (!empty($data['password'])) {
            $stmt->bindParam(':password', $password_hash);
        }

        return $stmt->execute();
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                return "constraint_error"; 
            }
            return false;
        }
    }
}