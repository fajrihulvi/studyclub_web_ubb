<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_matakuliah']);
    $sks = (int) $_POST['sks'];
    $hari = $_POST['hari'];

    $stmt = $conn->prepare("INSERT INTO matakuliah (nama_matakuliah, sks, hari) VALUES (:nama, :sks, :hari)");
    $stmt->execute(['nama' => $nama, 'sks' => $sks, 'hari' => $hari]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Mata Kuliah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm rounded-4">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">Tambah Mata Kuliah</h5>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama Mata Kuliah</label>
          <input type="text" name="nama_matakuliah" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">SKS</label>
          <input type="number" name="sks" class="form-control" min="1" max="4" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Hari</label>
          <select name="hari" class="form-select" required>
            <option value="">-- Pilih Hari --</option>
            <?php
            $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            foreach ($hariList as $h) echo "<option value='$h'>$h</option>";
            ?>
          </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
