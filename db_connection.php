<?php
$host = 'localhost';
$db = 'user_management';
$user = 'root'; // Sesuaikan dengan username MySQL
$pass = ''; // Sesuaikan dengan password MySQL 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
