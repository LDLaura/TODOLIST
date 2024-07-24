<?php
//Ouvrir la session pour pouvoir récupérer les valeurs sotckées dans $_SESSION
session_start();

//Vérifier que l'utilisateur soit connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once '../service/db_connect.php';

$id = $_SESSION['id'];

$request = $db_connexion->prepare('SELECT idListe, title, content, createdAt FROM list WHERE idUsers = :id ORDER BY createdAt DESC LIMIT 5');
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
    <title>TO DO LIST : Mon compte</title>

    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/responsive/mainResponsive.css">
    <link rel="stylesheet" href="../style/monCompte.css">
    <link rel="stylesheet" href="../style/responsive/monCompteResponsive.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="../index.php"><img src="../images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="./liste/ajouterList.php">Ajouter Liste</a>
                </li>
                <li class="navbar-link">
                    <a href="./user/afficherUser.php">Mes infos</a>
                </li>
                <li class="navbar-link">
                    <a href="./user/deconnexion.php">Déconnexion</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Mes dernières To Do List :</h2>
        <ol class="main-content">
            

            <?php
            foreach ($resultat as $valeur) {
                
            ?>
                <div class="card">
                    <div class="header">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <?php echo'<a href="./liste/afficherList.php?id='.$valeur['idListe'].'" class="title">'. $valeur['title'].' </a>'?>
                    </div>
                    <p class="date"><?php $date = date_create($valeur['createdAt']); echo date_format($date, 'd-M-Y'); ?> </p>
                    <div class="button">
                        <form action="#" method="POST">
                            <a href="./liste/modifierList.php" class="modify">Modifier</a>
                        </form>
                        <form action="./liste/supprimerList.php" method="GET">
                            <input type="hidden" name="idListe" value="<?= $valeur['idListe'] ?>">
                            <button type="submit" class="delete">Supprimer</button>
                        </form>
                    </div>
                </div>

            <?php
            }
            ?>

        </ol>

    </main>

</body>

</html>