<?php
require 'config.php';
if (!isset($_SESSION['logged_in'])) exit(header("Location: login.php"));

$result = $conn->query("SELECT * FROM barang ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $t['manage'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><?= $t['manage'] ?></h2>
            <div>
                <a href="index.php" class="btn btn-secondary"><?= $t['back'] ?></a>
                <a href="create.php" class="btn btn-success">+ <?= $t['add'] ?></a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>NO</th>
                            <th><?= $t['code'] ?></th>
                            <th><?= $t['name'] ?></th>
                            <th><?= $t['category'] ?></th>
                            <th><?= $t['qty'] ?></th>
                            <th width="150"><?= $t['action'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($row = $result->fetch_assoc()): 
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['kode_barang']) ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['jumlah']) ?></td>
                            <td class="text-center">
                                <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><?= $t['edit'] ?></a>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?= $t['confirm_delete'] ?>')"><?= $t['delete'] ?></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        
                        <?php if($result->num_rows == 0): ?>
                        <tr>
                            <td colspan="6" class="text-center">Data tidak tersedia</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>