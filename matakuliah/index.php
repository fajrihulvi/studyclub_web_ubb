<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$stmt = $conn->query("SELECT * FROM matakuliah ORDER BY id DESC");
$matakuliah = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Mata Kuliah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../dashboard.php">Dashboard</a>
    <div class="d-flex">
      <a href="../logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="card shadow-sm rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar Mata Kuliah</h5>
      <a href="create.php" class="btn btn-light btn-sm">+ Tambah</a>
    </div>

    <div class="card-body">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>NO</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Hari</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $no = 1;
          foreach ($matakuliah as $m): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($m['nama_matakuliah']) ?></td>
            <td><?= $m['sks'] ?></td>
            <td><?= htmlspecialchars($m['hari']) ?></td>
            <td>
              <a href="edit.php?id=<?= $m['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="delete.php?id=<?= $m['id'] ?>" class="btn btn-danger btn-sm" 
                 onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>