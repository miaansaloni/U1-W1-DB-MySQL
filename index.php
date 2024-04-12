<?php
// connessione al database
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

// Inserimento dei dati nel database quando il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    // Preparazione della query di inserimento
    $stmt = $pdo->prepare("INSERT INTO users (name, surname, age, email) VALUES (?, ?, ?, ?)");
    // Esecuzione della query
    $stmt->execute([$name, $surname, $age, $email]);
}

// SELECT DI TUTTE LE RIGHE
$stmt = $pdo->query('SELECT * FROM users');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Aggiungi Utente</h2>
    <form method="post">
        <label for="name">Nome:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="surname">Cognome:</label><br>
        <input type="text" id="surname" name="surname"><br>
        <label for="age">Età:</label><br>
        <input type="text" id="age" name="age"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br><br>
        <input type="submit" value="Aggiungi">
    </form>

    <h2>Lista Utenti</h2>
    <ul>
        <?php foreach ($stmt as $row) {?>
            <li>
                <?= "$row[userID] - $row[name] - $row[surname] - $row[age] - $row[email]"?>
                <a href="/U1-W1-DB-MySQL/dettagli.php?id=<?= $row['userID'] ?>">dettagli</a>
                <a href="/U1-W1-DB-MySQL/elimina.php?id=<?= $row['userID'] ?>">elimina</a>
            </li>
        <?php }?>
    </ul>
</body>
</html>
