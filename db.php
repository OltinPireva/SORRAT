<?php
$host = 'sql201.infinityfree.com';
$dbname = 'if0_37747653_oltin';
$user = 'if0_37747653';
$password = 'w2uaEWY887X'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

