<?php
require 'config.php';
if (!isset($_SESSION['logged_in'])) exit(header("Location: login.php"));

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = htmlspecialchars(trim($_POST['kode_barang']));
    $nama = htmlspecialchars(trim($_POST['nama_barang']));
    $kategori = htmlspecialchars(trim($_POST['kategori']));
    $jumlah = filter_var($_POST['jumlah'], FILTER_VALIDATE_INT);

    if (empty($kode) || empty($nama) || empty($kategori) || $jumlah === false) {
        $error = $t['empty'];
    } else {
        $stmt = $conn->prepare("INSERT INTO barang (kode_barang, nama_barang, kategori, jumlah) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $kode, $nama, $kategori, $jumlah);
        if ($stmt->execute()) {
            header("Location: barang.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $t['add'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 500px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><?= $t['add'] ?></h4>
            </div>
            <div class="card-body">
                <?php if($error): ?>
                    <div class="alert alert-danger py-2"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label"><?= $t['code'] ?></label>
                        <input type="text" name="kode_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= $t['name'] ?></label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= $t['category'] ?></label>
                        <input type="text" name="kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= $t['qty'] ?></label>
                        <input type="number" min="0" name="jumlah" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success"><?= $t['save'] ?></button>
                    <a href="barang.php" class="btn btn-secondary"><?= $t['cancel'] ?></a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>