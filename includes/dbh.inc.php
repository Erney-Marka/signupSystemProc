<?php

$host = "mysql:host=localhost;dbname=dbsignup";
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO($host, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { // 
    die('Connection failed: ' . $e->getMessage());
}
