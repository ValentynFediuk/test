<?php
$pdo = require __DIR__ . '/db.php';
$sql = file_get_contents(__DIR__ . '/migrations/001_init.sql');
$pdo->exec($sql);
echo "Migration applied\n";
