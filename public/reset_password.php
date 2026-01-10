<?php
require_once '../app/config/Database.php';

try {
    $db = new Database();
    $conn = $db->conn;

    $password_baru = password_hash('123', PASSWORD_DEFAULT);

    $query1 = "UPDATE users SET password = :pass WHERE username = 'admin'";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bindParam(':pass', $password_baru);
    $stmt1->execute();

    $query2 = "UPDATE users SET password = :pass WHERE username = 'user'";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(':pass', $password_baru);
    $stmt2->execute();

    echo "<h1>SUKSES! Password berhasil di-reset.</h1>";
    echo "<p>Password untuk admin dan user sekarang adalah: <strong>123</strong></p>";
    echo "<p>Kode Hash baru: " . $password_baru . "</p>";
    echo "<br><a href='/aplikasi_manajemen_produk/public/auth/login'>Klik disini untuk Login</a>";

} catch (Exception $e) {
    echo "Gagal: " . $e->getMessage();
}