<?php
require 'config.php';
if (isset($_SESSION['logged_in'])) header("Location: index.php");

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['logged_in'] = true;
                header("Location: index.php");
                exit;
            }
        }
        $error = $t['wrong_login'];
    } else {
        $error = $t['empty'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $t['login'] ?> - <?= $t['app_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow" style="width: 350px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4"><?= $t['app_name'] ?></h3>
            <?php if($error): ?>
                <div class="alert alert-danger py-2"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100"><?= $t['login'] ?></button>
            </form>
        </div>
    </div>
</body>
</html>