# UAS Pemrograman Web 1

**Nama:** Mahfuz Fauzi  
**Kelas:** TI.24.A.3  
**NIM:** 312410412  
**Mata Kuliah:** Pemrograman Web 1  
**Dosen Pengampu:** Agung Nugroho, S.Kom., M.Kom  
**Universitas Pelita Bangsa**

---

# 🛒 Aplikasi Manajemen Produk (Toko Mahfuz)

> **Aplikasi Kasir & Inventaris Berbasis Web dengan PHP Native.**

![Banner Project](screenshots/dashboard.png)
*(Ganti gambar ini dengan screenshot dashboard utama)*

## 📖 Deskripsi Project

Aplikasi ini adalah sistem manajemen toko sederhana yang dibangun menggunakan **PHP Native** dengan paradigma **Object-Oriented Programming (OOP)** dan pola arsitektur **Model-View-Controller (MVC)**.

Aplikasi ini dirancang untuk menangani proses bisnis dasar sebuah toko, mulai dari pengelolaan data barang (inventaris), manajemen pengguna (admin/kasir), hingga pencatatan transaksi penjualan (Point of Sales) dan pelaporan.

Tujuan utama pembuatan aplikasi ini adalah untuk mendemonstrasikan implementasi konsep:
* **Encapsulation & Inheritance** dalam PHP.
* **Routing & Controller** dalam arsitektur MVC.
* **Database Handling** menggunakan PDO (PHP Data Objects).
* **Keamanan Dasar** (Session Management & Password Hashing).

---

## 🚀 Fitur Utama

### 1. Manajemen Produk (Inventory)
* **CRUD Produk:** Tambah, Lihat, Edit, dan Hapus data barang.
* **Stok Real-time:** Stok otomatis berkurang saat terjadi transaksi.
* **Upload Gambar:** Dukungan upload foto produk dengan rename otomatis (unik).
* **Pencarian & Pagination:** Fitur search barang dan navigasi halaman.

### 2. Transaksi & Kasir (Point of Sales)
* **Checkout System:** Form pembelian dengan input nama pembeli dan catatan.
* **Validasi Stok:** Sistem menolak pembelian jika stok habis.
* **Auto-Recording:** Transaksi otomatis tercatat di database laporan.

### 3. Laporan & Statistik
* **Dashboard Statistik:** Ringkasan total pendapatan dan jumlah barang terjual.
* **Riwayat Transaksi:** Tabel log penjualan lengkap (Waktu, Pembeli, Barang, Harga).
* **Cetak Laporan:** Fitur `Window.print()` untuk mencetak laporan ke PDF/Printer.
* **Reset Laporan:** Fitur membersihkan riwayat transaksi (Khusus Admin).

### 4. Manajemen Pengguna (User Management)
* **Multi-Role:** Akses berbeda untuk **Admin** (Full Akses) dan **User** (Terbatas).
* **CRUD User:** Admin bisa menambah, mengedit, dan menghapus user lain.
* **Edit Profil:** User bisa mengubah username dan password sendiri.

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
| :--- | :--- |
| **Backend** | PHP 8 (Native OOP) |
| **Database** | MySQL / MariaDB |
| **Driver DB** | PDO (PHP Data Objects) |
| **Frontend** | HTML5, CSS3 (Glassmorphism UI) |
| **Framework CSS** | Bootstrap 5 |
| **Icons** | Bootstrap Icons |
| **Server** | Apache (XAMPP) |

---

## 📂 Struktur Folder (Konsep MVC)

Aplikasi ini memisahkan logika (Controller), data (Model), dan tampilan (View) ke dalam folder terpisah:

```text
/aplikasi_manajemen_produk
├── app/
│   ├── config/          # Konfigurasi Database
│   ├── controllers/     # Logika penghubung (ProductController, UserController)
│   ├── core/            # Core system (Database Wrapper, App Routing)
│   ├── models/          # Query Database (ProductModel, TransactionModel)
│   └── views/           # Tampilan antarmuka (.php files)
├── public/
│   ├── css/             # File CSS Custom
│   ├── img/             # Tempat penyimpanan foto produk
│   └── index.php        # Entry Point (Gerbang Utama Aplikasi)
└── README.md            # Dokumentasi ini
```

## 📸 Screenshot Aplikasi

Berikut adalah tampilan antarmuka aplikasi pada setiap proses:

1. Halaman Dashboard & Produk
Admin dapat melihat daftar produk dengan tampilan kartu atau tabel. (Pastikan file gambar ada di folder screenshots dengan nama produk_index.png)

2. Manajemen User
Fitur untuk mengelola akun admin dan user aplikasi.

3. Proses Checkout (Pembelian)
Form konfirmasi pembelian untuk mencatat data pelanggan.

4. Laporan Penjualan
Rekapitulasi transaksi yang bisa dicetak.

5. Edit Profil
Halaman untuk memperbarui informasi akun pribadi.

## ⚙️ Cara Instalasi & Menjalankan

Ikuti langkah ini untuk menjalankan project di komputer lokal:

Siapkan Server: Pastikan XAMPP atau Laragon sudah terinstall dan aktif (Apache & MySQL).

Simpan Folder: Letakkan folder project ini di dalam htdocs (jika XAMPP) atau www (jika Laragon).

Import Database:

Buka localhost/phpmyadmin.

Buat database baru bernama db_tugas_oop.

Import file database.sql (disertakan dalam project) ke database tersebut.

Konfigurasi Koneksi:

Cek file app/core/Database.php atau app/config/config.php.

Pastikan username (root) dan password database sesuai.

Jalankan:

Buka browser dan akses: http://localhost/aplikasi_manajemen_produk/public/product/index

Dibuat untuk memenuhi tugas Pemrograman Web 1.

Dibuat dengan ❤️ dan PHP Native.