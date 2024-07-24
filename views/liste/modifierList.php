<?php
session_start();

//Verifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import BDD
require_once '../../service/db_connect.php';

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
    <title>TO DO LIST : modifier une liste</title>

    <link rel="stylesheet" href="../../style/main.css">
    <link rel="stylesheet" href="../../style/responsive/mainResponsive.css">
    <link rel="stylesheet" href="../../style/formulaireList.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="/index.php"><img src="../../images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="../monCompte.php">Mes Listes</a>
                </li>
                <li class="navbar-link">
                    <a href="../user/deconnexion.php">Déconnexion</a>
                <li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form">
            <div class="form-container">
                <h1>Modifier une liste</h1>

                <form action="#" method="POST">
                    <div class="form-control">
                        <label for="title">Titre : </label>
                        <input type="text" name="title" id="title" required value="<?= $list['title'] ?>"><br>
                    </div>

                    <div class="form-control">
                        <label for="content">Contenu : </label>
                        <textarea name="content" id="content" rows=10 required><?= $list['content'] ?></textarea><br>
                    </div>

                    <div class="form-control">
                        <input type="submit" class="form-button" value="MODIDIER">
                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>