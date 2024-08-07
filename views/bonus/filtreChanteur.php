<?php
    require_once '../../service/db_connect_music.php';

    $request = 'SELECT id, nom FROM artiste WHERE estchanteur = 1';
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
    <link rel="stylesheet" href="../../style/bonus/filtreChanteur.css">
</head>

<body>

    <header class="navbar">
        <nav class="navbar-content">
            <a href="../../index.php"><img src="../../images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                 <li class="navbar-link">
                    <a href="../bonus/bonus.php">Bibliothèque musicale</a>
                </li>
                <li class="navbar-link">
                    <a href="../../index.php" class="navbar-btn">ToDoList</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        foreach ($chanteurs as $chanteur) {
        ?>
            <div class="card">
                <div class="header">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.25 4.5a3.75 3.75 0 1 1 7.5 0v8.25a3.75 3.75 0 1 1-7.5 0V4.5Z" />
                            <path d="M6 10.5a.75.75 0 0 1 .75.75v1.5a5.25 5.25 0 1 0 10.5 0v-1.5a.75.75 0 0 1 1.5 0v1.5a6.751 6.751 0 0 1-6 6.709v2.291h3a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1 0-1.5h3v-2.291a6.751 6.751 0 0 1-6-6.709v-1.5A.75.75 0 0 1 6 10.5Z" />
                        </svg>
                    </div>
                    <?php echo '<a href="./chanteurs.php?id='.$chanteur['id'].'" class="title">' . $chanteur['nom'] . ' </a>' ?>
                </div>
            </div>
        <?php
        }
        ?>
    </main>
</body>

</html>