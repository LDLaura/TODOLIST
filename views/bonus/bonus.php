<?php
require_once '../../service/db_connect_music.php';

$request = 'SELECT nom FROM artiste WHERE estchanteur = 1';
$stmt = $db_connexion->query($request);
$chanteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BONUS : BDD MUSIC</title>

    <link rel="stylesheet" href="../../style/main.css">
    <link rel="stylesheet" href="../../style/responsive/mainResponsive.css">
    <link rel="stylesheet" href="../../style/bonus/bonus.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="../../index.php"><img src="../../images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="../../index.php" class="navbar-btn">
                        ToDoList
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>La bibliothèque musicale</h2>
        <div class="filtres">
            <div class="buttons">
                <a href="filtreChanteur.php" class="chanteurs">Voir tous les chanteurs</a>
            </div>
        </div>

    </main>
</body>

</html>