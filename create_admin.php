<?php
require_once(__DIR__ . '/db_connect.php');

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT); // Securely hashed

$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "Admin user created.";
?>
