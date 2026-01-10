<?php
class ProductModel {
    private $conn;
    private $table = "products";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getAll($keyword = "", $limit = 5, $start = 0) {
        $query = "SELECT * FROM " . $this->table . " WHERE name LIKE :keyword LIMIT :start, :limit";
        $stmt = $this->conn->prepare($query);
        $keyword = "%{$keyword}%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($keyword = "") {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE name LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $keyword = "%{$keyword}%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (name, price, stock, description, image) VALUES (:name, :price, :stock, :desc, :image)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " SET name = :name, price = :price, stock = :stock, description = :description, image = :image WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute(); 
    }

    public function delete($id) {
        $product = $this->getById($id);
        if($product['image'] != 'default.jpg' && file_exists('../public/img/' . $product['image'])){
            unlink('../public/img/' . $product['image']);
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function uploadImage($file) {
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $error    = $file['error'];
        $tmpName  = $file['tmp_name'];

        if ($error === 4) { 
            return 'default.jpg'; 
        }

        $validExtension = ['jpg', 'jpeg', 'png'];
        $fileExtension = explode('.', $fileName);
        $fileExtension = strtolower(end($fileExtension));
        
        if (!in_array($fileExtension, $validExtension)) {
            echo "<script>alert('Yang anda upload bukan gambar!');</script>";
            return false;
        }

        if ($fileSize > 2000000) {
            echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
            return false;
        }

        $newFileName = uniqid() . '.' . $fileExtension;

        move_uploaded_file($tmpName, '../public/img/' . $newFileName);

        return $newFileName;
    }

    public function buyProduct($id) {
        $product = $this->getById($id);
        
        if ($product && $product['stock'] > 0) {
            $query = "UPDATE " . $this->table . " SET stock = stock - 1 WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }
        
        return false;
    }

    public function decreaseStock($id) {
        $query = "UPDATE " . $this->table . " SET stock = stock - 1 WHERE id = :id AND stock > 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}