<?php 
$DB_HOST = 'localhost';
$DB_MHS = 'root';
$DB_PASS = '';
$DB_NAME = 'db_instiki';
$mysqli = new mysqli($DB_HOST, $DB_MHS, $DB_PASS);

if ($mysqli->connect_error) {
 die("Connection failed: " . $mysqli->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS db_instiki";
if (mysqli_query($mysqli, $sql)) {
    echo "Database berhasil dibuat";
    echo "<br>";
} else {
    echo "Database gagal dibuat: " . mysqli_error($mysqli);
    echo "<br>";
}
require_once('koneksi.php');

mysqli_select_db($mysqli, "db_instiki");

$sql = "CREATE TABLE IF NOT EXISTS tb_mhs_instiki (
 NIM INT PRIMARY KEY,
 Nama VARCHAR(100),
 Jurusan VARCHAR(50),
 Prodi VARCHAR(50)
)";

if (mysqli_query($mysqli, $sql)) {
 echo "Tabel berhasil dibuat";
 echo "<br>";
} else {
 echo "Tabel gagal dibuat: " . mysqli_error($mysqli);
 echo "<br>";
}

mysqli_close($mysqli);
?>

