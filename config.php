<?php
// config.php
$host = 'localhost';
$user = 'root';
$pass = ''; // sesuaikan password MySQL Anda
$dbname = 'db_aslab';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>