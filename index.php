<?php
require 'config.php';
if (!isset($_SESSION['logged_in'])) exit(header("Location: login.php"));

$stats = $conn->query("SELECT COUNT(id) as total_jenis, SUM(jumlah) as total_stok FROM barang")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $t['dashboard'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php"><?= $t['app_name'] ?></a>
            <div class="d-flex">
                <a href="?lang=id" class="btn btn-sm btn-outline-light me-2">IND</a>
                <a href="?lang=en" class="btn btn-sm btn-outline-light me-4">ENG</a>
                <a href="logout.php" class="btn btn-sm btn-danger"><?= $t['logout'] ?></a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4"><?= $t['dashboard'] ?></h2>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3 shadow-sm">
                    <div class="card-body text-center">
                        <h1 class="card-title display-4"><?= $stats['total_jenis'] ?? 0 ?></h1>
                        <p class="card-text fs-5"><?= $t['total_items'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-success mb-3 shadow-sm">
                    <div class="card-body text-center">
                        <h1 class="card-title display-4"><?= $stats['total_stok'] ?? 0 ?></h1>
                        <p class="card-text fs-5"><?= $t['total_stock'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <a href="barang.php" class="btn btn-primary btn-lg"><?= $t['manage'] ?> &rarr;</a>
    </div>
</body>
</html>