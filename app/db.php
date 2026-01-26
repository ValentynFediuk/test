<?php
$databaseUrl = getenv('DATABASE_URL');

if (!$databaseUrl) {
    throw new Exception("DB Connection failed: DATABASE_URL not set in environment");
}

// Parse URL
$components = parse_url($databaseUrl);
if (!$components || !isset($components['host'], $components['user'], $components['pass'], $components['path'])) {
    throw new Exception("DB Connection failed: Invalid DATABASE_URL format");
}

$host = $components['host'];
$port = isset($components['port']) ? $components['port'] : 5432; // якщо порт не вказаний, юзаємо дефолтний 5432
$db   = ltrim($components['path'], '/'); // відрізаємо провідний "/"
$user = $components['user'];
$pass = $components['pass'];

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Success
} catch (PDOException $e) {
    throw new Exception("DB Connection failed: " . $e->getMessage());
}
