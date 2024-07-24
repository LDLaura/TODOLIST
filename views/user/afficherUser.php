<?php
//Ouvrir la session pour pouvoir récupérer les valeurs sotckées dans $_SESSION
session_start();

//Vérifier que l'utilisateur soit connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once '../../service/db_connect.php';

$id = $_SESSION['id'];

$request = $db_connexion->prepare('SELECT id, login, password FROM users WHERE id = :id ');
$request->bindParam(':id', $id);
$request->execute();

$resultat = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
    <title>TO DO LIST : Mes infos</title>

    <link rel="stylesheet" href="../../style/main.css">
    <link rel="stylesheet" href="../../style/responsive/mainResponsive.css">
    <link rel="stylesheet" href="../../style//afficherUser.css">
    <link rel="stylesheet" href="../../style/responsive/afficherUserResponsive.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="../../index.php"><img src="../../images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="../monCompte.php">Mes Listes</a>
                </li>
                <li class="navbar-link">
                    <a href="deconnexion.php">Déconnexion</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Mes informations :</h2>
        <section class="main-content">
            <?php
            //Affichage des infos de l'utilisateur
            foreach ($resultat as $valeur) {
            ?>
                <div class="card">
                    <div class="header">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <p class="login"> <?= $valeur['login'] ?></p>
                    </div>
                    <p class="password">Mot de passe : **********</p>

                    <div class="button">
                        <form action="#" method="POST">
                            <a href="../user/modifierUser.php" class="modify">Modifier</a>
                        </form>
                        <form action="supprimerUser.php" method="GET">
                            <input type="hidden" name="idListe" value="<?= $valeur['id'] ?>">
                            <button type="submit" class="delete" id="delete">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </main>
</body>

</html>