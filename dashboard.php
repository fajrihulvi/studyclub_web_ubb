<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Dashboard</span>
    <a href="profile.php" class="btn btn-outline-light btn-sm">Profile</a>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
  </div>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4>Selamat datang, <?= htmlspecialchars($user['nama_lengkap']) ?></h4>
        <p>Email Anda: <strong><?= htmlspecialchars($user['email']) ?></strong></p>

        <?php if ($user['role'] === 'ADMIN'): ?>
            <div class="alert alert-info mt-3">Anda masuk sebagai <b>Administrator</b>.</div>
        <?php else: ?>
            <div class="alert alert-success mt-3">Anda masuk sebagai <b>Operator</b>.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
