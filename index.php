<?php
include __DIR__ . '/includes/db.php';

$totalUsersStmt = $pdo->query('SELECT COUNT(*) FROM users');
$totalUsers = $totalUsersStmt->fetchColumn();
$usersPerPage = 4;
$totalPages = ceil($totalUsers / $usersPerPage);
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($current_page - 1) * $usersPerPage;

// Inserimento dei dati nel database quando il form viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (name, surname, age, email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $surname, $age, $email]);
}

// SELECT DI TUTTE LE RIGHE O DI RIGHE FILTRATE PER RICERCA
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE ? LIMIT ?, ?");
    $stmt->execute(["%$search%", $offset, $usersPerPage]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM users LIMIT ?, ?");
    $stmt->execute([$offset, $usersPerPage]);
}

include __DIR__ . '/includes/init.php'; ?>

<form class="row g-3">
        <div class="col">
            <input type="text" name="search" class="form-control" placeholder="Search..">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">search</button>
        </div>
    </form>

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
                <a href="/U1-W1-DB-MySQL/details.php?id=<?= $row['userID'] ?>">Details</a>
                <a href="/U1-W1-DB-MySQL/delete.php?id=<?= $row['userID'] ?>">Delete</a>
                <a href="/U1-W1-DB-MySQL/edit.php?id=<?= $row['userID'] ?>">Edit</a>
            </li>
        <?php }?>
    </ul>


<nav>
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++) {?>
            <li class="page-item <?= $i === $current_page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?><?= isset($_GET['search']) ? '&search=' . $_GET['search'] : '' ?>"><?= $i ?></a>
            </li>
        <?php }?>
    </ul>
</nav>
</div><?php
  
include __DIR__ . '/includes/end.php';
