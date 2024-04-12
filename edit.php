<?php
include __DIR__ . '/includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET name=?, surname=?, age=?, email=? WHERE userID=?");
    $stmt->execute([$name, $surname, $age, $email, $userID]);

    header("Location: /U1-W1-DB-MySQL/");
    exit();
}

// RECUPERO DEI DATI DA MODIFICARE
$userID = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE userID = ?");
$stmt->execute([$userID]);
$user = $stmt->fetch();
?>

<form method="post">
    <input type="hidden" name="userID" value="<?= $user['userID'] ?>">
    <label for="name">Nome:</label><br>
    <input type="text" id="name" name="name" value="<?= $user['name'] ?>"><br>
    <label for="surname">Cognome:</label><br>
    <input type="text" id="surname" name="surname" value="<?= $user['surname'] ?>"><br>
    <label for="age">Età:</label><br>
    <input type="text" id="age" name="age" value="<?= $user['age'] ?>"><br>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" value="<?= $user['email'] ?>"><br><br>
    <button type="submit">Salva modifiche</button>
</form><?php
include __DIR__ . '/includes/end.php';