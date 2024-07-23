<?php

session_start();

//Verifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once '../../service/db_connect.php';

//Dans l'url retrouver l'id de la liste
// Avec $_GET['idListe'] recupérer les infos de la liste

$idListe = $_GET['id'];

$request = 'SELECT title, content FROM list WHERE idListe = :idListe';
$stmt = $db_connexion->prepare($request);
$stmt->bindParam(':idListe', $idListe);

$stmt->execute();
$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = $resultat[0]['title'];
$content = $resultat[0]['content'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
    <title>TO DO LIST : Liste</title>

    <link rel="stylesheet" href="../../style/afficherList.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="../../index.php"><img src="../../images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="ajouterList.php">Ajouter Liste</a>
                </li>
                <li class="navbar-link">
                    <a href="../monCompte.php">Mes listes</a>
                </li>
                <li class="navbar-link">
                    <a href="#">Déconnexion</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="main-content">
            
            <div class="card">
                    <div class="header">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <p class="title"><?= $title ?></p>
                        </div>
                        <p class="content"><?= $content ?></p>
                </div>
        </section>
    </main>
</body>

</html>



