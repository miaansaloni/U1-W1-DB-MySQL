<?php
// connessione al database
// preparazione della query
// esecuzione della query
// usare i dati
$host = 'localhost';
$db   = 'users';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// comando che connette al database
$pdo = new PDO($dsn, $user, $pass, $options);

// SELECT DI TUTTE LE RIGHE
$stmt = $pdo->query('SELECT * FROM users');

// foreach ($stmt as $row)
// {
//     echo '<pre>' . print_r($row, true) . '</pre>';
//      echo "<li>$row[name]</li>";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<ul>
    <?php

foreach ($stmt as $row) {?>
<li>
    <?= "$row[userID] - $row[name] - $row[surname] - $row[age] - $row[email]"?>
    <a href="/U1-W1-DB-MySQL/dettagli.php?id=<?= $row['userID'] ?>">dettagli</a>
    <a href="/U1-W1-DB-MySQL/elimina.php?id=<?= $row['userID'] ?>">elimina</a>
</li><?php

}?>
</ul>

</body>
</html>