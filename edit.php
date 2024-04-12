<?php
include __DIR__ . '/includes/db.php';

// SELECT DI TUTTE LE RIGHE
$stmt = $pdo->prepare('SELECT * FROM users WHERE userID = ?');
$stmt->execute([$_GET["id"]]);

$row = $stmt->fetch();

include __DIR__ . '/includes/init.php'?>

    <h1><?= $row['name'] ?></h1>
    <h2><?= $row['surname'] ?></h2>
    <p><?= $row['age'] ?></p>
    <p><?= $row['email'] ?></p><?php
    
include __DIR__ . '/includes/end.php';