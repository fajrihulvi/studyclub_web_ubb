<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM matakuliah WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Data tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_matakuliah']);
    $sks = (int) $_POST['sks'];
    $hari = $_POST['hari'];

    $update = $conn->prepare("UPDATE matakuliah SET nama_matakuliah=:nama, sks=:sks, hari=:hari WHERE id=:id");
    $update->execute(['nama' => $nama, 'sks' => $sks, 'hari' => $hari, 'id' => $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Mata Kuliah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm rounded-4">
    <div class="card-header bg-warning text-dark">
      <h5 class="mb-0">Edit Mata Kuliah</h5>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama Mata Kuliah</label>
          <input type="text" name="nama_matakuliah" class="form-control" value="<?= htmlspecialchars($data['nama_matakuliah']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">SKS</label>
          <input type="number" name="sks" class="form-control" min="1" max="6" value="<?= $data['sks'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Hari</label>
          <select name="hari" class="form-select" required>
            <?php
            $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            foreach ($hariList as $h) {
                $selected = $data['hari'] === $h ? 'selected' : '';
                echo "<option value='$h' $selected>$h</option>";
            }
            ?>
          </select>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>
