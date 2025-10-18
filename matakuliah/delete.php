<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $conn->prepare("DELETE FROM matakuliah WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header('Location: index.php');
exit;
?>
