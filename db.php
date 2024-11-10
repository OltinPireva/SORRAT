<?php
$host = 'localhost';
$dbname = 'inventory_system';
$username = 'root';
$password = ''; // Vendosni fjalëkalimin tuaj nëse përdorni një bazë të dhënash të mbrojtur

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
