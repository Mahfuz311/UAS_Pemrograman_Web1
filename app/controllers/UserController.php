<?php
class UserController {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /aplikasi_manajemen_produk/public/auth/login");
            exit;
        }
    }

    public function index() {
        $model = new UserModel();
        $users = $model->getAll();

        require_once '../app/views/layout/header.php';
        require_once '../app/views/user/index.php';
        require_once '../app/views/layout/footer.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new UserModel();
            
            if ($model->getUserByUsername($_POST['username'])) {
                echo "<script>alert('Username sudah terpakai!'); window.location='/aplikasi_manajemen_produk/public/user/add';</script>";
                return;
            }

            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'role'     => $_POST['role']
            ];

            if ($model->create($data)) {
                header("Location: /aplikasi_manajemen_produk/public/user/index");
            }
        }

        require_once '../app/views/layout/header.php';
        require_once '../app/views/user/form.php';
        require_once '../app/views/layout/footer.php';
    }

    public function edit($id) {
        $model = new UserModel();
        
        $user = $model->getById($id);
        $isEdit = true;

        require_once '../app/views/layout/header.php';
        require_once '../app/views/user/form.php';
        require_once '../app/views/layout/footer.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new UserModel();
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'role'     => $_POST['role']
            ];
            
            if ($model->update($_POST['id'], $data)) {
                header("Location: /aplikasi_manajemen_produk/public/user/index");
            }
        }
    }

    public function delete($id) {
        if ($id == $_SESSION['user_id']) {
            echo "<script>alert('Anda tidak bisa menghapus akun sendiri!'); window.location='/aplikasi_manajemen_produk/public/user/index';</script>";
            exit;
        }

        $model = new UserModel();
        if ($model->delete($id)) {
            header("Location: /aplikasi_manajemen_produk/public/user/index");
        }
    }
}