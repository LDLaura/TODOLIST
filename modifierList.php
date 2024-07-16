<?php
session_start();

//Verifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once 'service/db_connect.php';

//Récupérer les données de la liste pour préremplir le formulaire
$id = $_SESSION['id'];
$request = 'SELECT title, content FROM list WHERE idUsers = :id';
$stmt = $db_connexion->prepare($request);
$stmt->bindParam(':id', $id);
$stmt->execute();

$list = $stmt->fetch();

//Valider, nettoyer les données qui ont été saisies dans le formulaire puis envoie la requête Update
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

    $request = 'UPDATE list SET title = :title, content = :content WHERE idUsers = :id';

    $stmt = $db_connexion->prepare($request);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    $nb = $stmt->rowCount();

    if ($nb > 0) {
        header('Location: monCompte.php');
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
    <title>TO DO LIST : modifier une liste</title>

    <link rel="stylesheet" href="./style/modifierList.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="http://localhost/TODOLIST/"><img src="./images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="#">Déconnexion</a>
            </ul>
        </nav>
    </header>

    <main>
        <form action="#" method="POST">
            <fieldset>
                <legend>Modifier votre liste</legend>

                <label for="title">Titre : </label>
                <input type="text" name="title" id="title" value="<?= $list['title'] ?>"><br>

                <label for="content">Contenu : </label>
                <input type="text" name="content" id="content" value="<?= $list['content'] ?>"><br>

                <input type="submit" value="MODIFIER">

            </fieldset>
        </form>
    </main>

</body>

</html>