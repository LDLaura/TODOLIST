<?php
session_start();

//Verifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once '../../service/db_connect.php';

//Récupérer les données du formumaire après validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(
        INPUT_POST,
        [
            'title' => FILTER_SANITIZE_SPECIAL_CHARS,
            'content' => FILTER_SANITIZE_SPECIAL_CHARS,
        ]
    );
    $title = $_POST['title'];
    $content = $_POST['content'];
    $idUser = $_SESSION['id'];

    $request = "INSERT INTO list (title, content, createdAt, idUsers) VALUES (:title, :content, NOW(), $idUser)";

    $stmt = $db_connexion->prepare($request);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->execute();

    $nb = $stmt->rowCount();

    if ($nb > 0) {
        header('Location: ../monCompte.php');
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
    <title>TO DO LIST : ajouter une liste</title>

    <link rel="stylesheet" href="../../style/ajouterList.css">
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
                    <a href="../user/deconnexion.php">Déconnexion</a>
                </li>
            </ul>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form">
            <div class="form-container">
                <h1>Ajouter une liste</h1>

                <form action="#" method="POST">
                    <div class="form-control">
                        <label for="title">Titre : </label>
                        <input type="text" name="title" id="title" required>
                    </div>

                    <div class="form-control">
                        <label for="content">Contenu : </label>
                        <textarea name="content" id="content" rows=10 required></textarea>
                    </div>

                    <div class="form-control">
                        <input type="submit" class="form-button" value="AJOUTER">
                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>