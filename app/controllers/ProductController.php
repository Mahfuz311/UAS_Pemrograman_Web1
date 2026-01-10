<?php
class ProductController {
    public function index() {
        if (!isset($_SESSION['user_id'])) { 
            header("Location: /aplikasi_manajemen_produk/public/auth/login"); 
            exit; 
        }

        $model = new ProductModel();
        
        $keyword = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $start = ($page > 1) ? ($page * $limit) - $limit : 0;

        $products = $model->getAll($keyword, $limit, $start);
        $total_data = $model->countAll($keyword);
        $total_pages = ceil($total_data / $limit);

        require_once '../app/views/layout/header.php';
        require_once '../app/views/product/index.php';
        require_once '../app/views/layout/footer.php';
    }

    public function detail($id) {
        if (!isset($_SESSION['user_id'])) { 
            header("Location: /aplikasi_manajemen_produk/public/auth/login"); 
            exit; 
        }

        $model = new ProductModel();
        $product = $model->getById($id);

        require_once '../app/views/layout/header.php';
        require_once '../app/views/product/detail.php';
        require_once '../app/views/layout/footer.php';
    }

    public function add() {
        if ($_SESSION['role'] !== 'admin') { echo "Akses Ditolak"; exit; }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new ProductModel();
            
            $image = $model->uploadImage($_FILES['image']);
            if (!$image) return;

            $data = [
                ':name' => $_POST['name'],
                ':price' => $_POST['price'],
                ':stock' => $_POST['stock'],
                ':desc' => $_POST['description'],
                ':image' => $image
            ];

            if($model->create($data)){
                header("Location: /aplikasi_manajemen_produk/public/product/index");
            }
        }
        
        require_once '../app/views/layout/header.php';
        require_once '../app/views/product/form.php';
        require_once '../app/views/layout/footer.php';
    }

    public function edit($id) {
        if ($_SESSION['role'] !== 'admin') { echo "Akses Ditolak"; exit; }
        
        $model = new ProductModel();
        $product = $model->getById($id);
        
        $isEdit = true;
        require_once '../app/views/layout/header.php';
        require_once '../app/views/product/form.php';
        require_once '../app/views/layout/footer.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new ProductModel();
            
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'description' => $_POST['description']
            ];

            if (!empty($_FILES['image']['name'])) {
                $oldProduct = $model->getById($_POST['id']);

                $oldFile = '../public/img/' . $oldProduct['image'];
                if ($oldProduct['image'] != 'default.jpg' && file_exists($oldFile)) {
                    unlink($oldFile);
                }

                $target_dir = "../public/img/";
                $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;
                
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                
                $data['image'] = $new_filename;
            } else {
                $data['image'] = $_POST['old_image'];
            }

            if ($model->update($_POST['id'], $data)) {
                header("Location: /aplikasi_manajemen_produk/public/product/index");
            }
        }
    }

    public function delete($id) {
        $model = new ProductModel();

        $product = $model->getById($id);

        if ($product) {
            $target_file = '../public/img/' . $product['image'];
            
            if ($product['image'] != 'default.jpg' && file_exists($target_file)) {
                unlink($target_file);
            }
        }

        if ($model->delete($id)) {
            header("Location: /aplikasi_manajemen_produk/public/product/index");
        }
    }

    public function buy($id) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /aplikasi_manajemen_produk/public/auth/login");
            exit;
        }

        $model = new ProductModel();
        $product = $model->getById($id);

        if (!$product || $product['stock'] < 1) {
            echo "<script>alert('Stok Habis!'); window.location='/aplikasi_manajemen_produk/public/product/index';</script>";
            exit;
        }

        require_once '../app/views/layout/header.php';
        require_once '../app/views/product/checkout.php';
        require_once '../app/views/layout/footer.php';
    }

    public function processBuy() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['product_id'];
            $buyerName = $_POST['buyer_name'];
            $notes = $_POST['notes'];
            $price = $_POST['price'];

            $model = new ProductModel();
            
            $product = $model->getById($id);
            if ($product['stock'] > 0) {
                
                if ($model->decreaseStock($id)) {
                    
                    require_once '../app/models/TransactionModel.php';
                    $trxModel = new TransactionModel();
                    
                    $trxModel->create($_SESSION['user_id'], $id, $price, $buyerName, $notes);
                    
                    echo "<script>
                            alert('Transaksi Sukses! Terima kasih, $buyerName.');
                            window.location='/aplikasi_manajemen_produk/public/product/index';
                          </script>";
                }
            } else {
                echo "<script>alert('Gagal! Stok tiba-tiba habis.'); window.location='/aplikasi_manajemen_produk/public/product/index';</script>";
            }
        }
    }
}