<?php
require 'db.php';
global $pdo;
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id=:id");
$stmt->execute(['id' => $id]);

header("Location: /");
