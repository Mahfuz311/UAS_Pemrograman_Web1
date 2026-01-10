<?php
class TransactionController {
    
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /aplikasi_manajemen_produk/public/product/index");
            exit;
        }
    }

    public function index() {
        require_once '../app/models/TransactionModel.php';
        $model = new TransactionModel();
        
        $transactions = $model->getAll();

        require_once '../app/views/layout/header.php';
        require_once '../app/views/transaction/index.php';
        require_once '../app/views/layout/footer.php';
    }

    public function clear() {
        if ($_SESSION['role'] !== 'admin') {
            header("Location: /aplikasi_manajemen_produk/public/transaction/index");
            exit;
        }

        $model = new TransactionModel();
        if ($model->clearAll()) {
            echo "<script>
                    alert('Laporan berhasil di-reset! Semua riwayat transaksi telah dihapus.');
                    window.location='/aplikasi_manajemen_produk/public/transaction/index';
                  </script>";
        }
    }
}