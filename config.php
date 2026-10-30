<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = ''; // Sesuaikan jika database Anda memiliki password
$db   = 'db_inventaris';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fitur Dual Bahasa
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$active_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'id';

$lang = [
    'id' => [
        'app_name' => 'Manajemen Inventaris',
        'dashboard' => 'Dasbor Utama',
        'total_items' => 'Total Jenis Barang',
        'total_stock' => 'Total Stok Fisik',
        'manage' => 'Kelola Data Barang',
        'back' => 'Kembali',
        'login' => 'Masuk',
        'logout' => 'Keluar',
        'add' => 'Tambah Barang',
        'edit_data' => 'Ubah Data Barang',
        'code' => 'Kode Barang',
        'name' => 'Nama Barang',
        'category' => 'Kategori',
        'qty' => 'Jumlah',
        'action' => 'Aksi',
        'edit' => 'Ubah',
        'delete' => 'Hapus',
        'save' => 'Simpan',
        'cancel' => 'Batal',
        'empty' => 'Semua form harus diisi dengan benar!',
        'wrong_login' => 'Username atau password salah!',
        'confirm_delete' => 'Yakin ingin menghapus barang ini?'
    ],
    'en' => [
        'app_name' => 'Inventory Management',
        'dashboard' => 'Main Dashboard',
        'total_items' => 'Total Item Types',
        'total_stock' => 'Total Physical Stock',
        'manage' => 'Manage Items',
        'back' => 'Back',
        'login' => 'Login',
        'logout' => 'Logout',
        'add' => 'Add Item',
        'edit_data' => 'Edit Item Data',
        'code' => 'Item Code',
        'name' => 'Item Name',
        'category' => 'Category',
        'qty' => 'Quantity',
        'action' => 'Action',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'empty' => 'All fields must be filled correctly!',
        'wrong_login' => 'Incorrect username or password!',
        'confirm_delete' => 'Are you sure you want to delete this item?'
    ]
];
$t = $lang[$active_lang];
?>