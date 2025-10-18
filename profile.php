<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user['id']]);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$profile) {
    die("Data user tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Profile Ku</a>
    <div class="d-flex">
      <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
      <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="mb-0">Profil Pengguna</h4>
        </div>

        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-md-4 text-muted fw-semibold">Username</div>
                <div class="col-md-8"><?= htmlspecialchars($profile['username']) ?></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 text-muted fw-semibold">Nama Lengkap</div>
                <div class="col-md-8"><?= htmlspecialchars($profile['nama_lengkap']) ?></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 text-muted fw-semibold">Email</div>
                <div class="col-md-8"><?= htmlspecialchars($profile['email']) ?></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 text-muted fw-semibold">Role</div>
                <div class="col-md-8">
                    <span class="badge 
                        <?= $profile['role'] === 'ADMIN' ? 'bg-danger' : 'bg-success' ?>">
                        <?= htmlspecialchars($profile['role']) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
