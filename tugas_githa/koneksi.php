<?php
$DB_HOST = 'localhost';
$DB_MHS = 'root';
$DB_PASS = '';
$DB_NAME = 'db_instiki';
// Koneksi ke database
$mysqli = mysqli_connect($DB_HOST, $DB_MHS, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}
?>