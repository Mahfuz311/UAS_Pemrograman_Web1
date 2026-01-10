<?php
class AuthController {
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header("Location: /aplikasi_manajemen_produk/public/product/index");
            exit;
        }
        require_once '../app/views/auth/login.php';
    }

    public function authenticate() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: /aplikasi_manajemen_produk/public/product/index");
        } else {
            echo "<script>alert('Username atau Password Salah!'); window.location='/aplikasi_manajemen_produk/public/auth/login';</script>";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /aplikasi_manajemen_produk/public/auth/login");
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /aplikasi_manajemen_produk/public/auth/login");
            exit;
        }

        $model = new UserModel();
        $user = $model->getById($_SESSION['user_id']);

        require_once '../app/views/layout/header.php';
        require_once '../app/views/auth/profile.php';
        require_once '../app/views/layout/footer.php';
    }

    public function updateProfile() {
        if (!isset($_SESSION['user_id'])) { exit; }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new UserModel();
            
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ];

            if ($model->update($_SESSION['user_id'], $data)) {
                $_SESSION['username'] = $_POST['username'];

                echo "<script>
                        alert('Profil berhasil diperbarui!');
                        window.location='/aplikasi_manajemen_produk/public/product/index';
                      </script>";
            } else {
                echo "<script>
                        alert('Gagal update profil.');
                        window.location='/aplikasi_manajemen_produk/public/auth/profile';
                      </script>";
            }
        }
    }
}