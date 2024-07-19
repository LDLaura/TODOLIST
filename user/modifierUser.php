<?php

session_start();

//Verifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once '../service/db_connect.php';

//Récupérer les données de la liste pour préremplir le formulaire
$id = $_SESSION['id'];
$request = 'SELECT login, password FROM users WHERE id = :id';
$stmt = $db_connexion->prepare($request);
$stmt->bindParam(':id', $id);
$stmt->execute();

$user = $stmt->fetch();

//Valider, nettoyer les données qui ont été saisies dans le formulaire puis envoie la requête Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(
        INPUT_POST,
        [
            'login' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        ]
    );

    $login = $_POST['login'];
    $password = $_POST['password'];

    $request = 'UPDATE users SET login = :login, password = :password WHERE id = :id';

    $stmt = $db_connexion->prepare($request);

    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    $nb = $stmt->rowCount();

    if ($nb > 0) {
        header('Location: afficherUser.php');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
    <title>TO DO LIST : modifier mes infos</title>

    <link rel="stylesheet" href="../style/modifierUser.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="index.php"><img src="../images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="deconnexion.php">Déconnexion</a>
                <li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="#" method="POST">
            <fieldset>
                <legend>Modifier vos infos</legend>

                <label for="login">Login : </label>
                <input type="text" name="login" id="login" value="<?= $user['login'] ?>"><br>

                <label for="password">Nouveau mot de passe : </label>
                <input type="password" name="password" id="password"><br>

                <input type="submit" value="MODIFIER">

            </fieldset>
        </form>
    </main>

</body>

</html>