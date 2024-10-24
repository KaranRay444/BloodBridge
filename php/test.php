<?php
include 'connect.php';

$username = 'karanray444';
$password = password_hash('admin', PASSWORD_DEFAULT);
$role = 'admin';

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $role);
$stmt->execute();
$stmt->close();
$conn->close();
?>