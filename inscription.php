<?php
require_once 'service/db_connect.php';

//Ouvrir la session
session_start();

//Création des constantes pour les erreurs
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'Le mot de passe ne répond pas aux nombre de caractères demandés (10)';

//Création d'un tableau qui recevra les erreurs
$errors = [
    'login' => '',
    'password' => ''
];
$message = '';

//Traitement des données avec la methode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'login' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);
    //Initialisation des variables qui vont recevoir les datas des champs du formulaire    
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    //Remplissage du tableau des erreurs
    if (!$login) {
        $errors['login'] = ERROR_REQUIRED;
    }
    if (!$password) {
        $errors['password'] = ERROR_REQUIRED;
    } elseif (mb_strlen($password) < 10) {
        $errors['password'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }

    //Executer la requête INSERT INTO
    if (($login) && ($password) && (mb_strlen($password) >= 10)) {
        //Vérifier que l'utilisateur n'existe pas en BDD avec SELECT
        $sql = 'SELECT login FROM users WHERE login = :login';
        if (isset($db_connexion)) {
            $db_statement = $db_connexion->prepare($sql);
        }
        $db_statement->execute(
            array(
                ':login' => $login
            )
        );

        //Si l'utilisateur n'existe pas, on traite la requête avec INSERT INTO
        $nb = $db_statement->rowCount();
        if ($nb <= 0) {
            $rqt = 'INSERT INTO users VALUES (DEFAULT, :login, :password)';
            $db_statement = $db_connexion->prepare($rqt);
            $db_statement->execute(
                array(
                    ':login' => $login,
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                )
            );
            $message = "<span class='message'>Votre compte a bien été créé !</span>";
        } else {
            $message = "<span classe='message'>Le login existe déjà !</span>";
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs avec un mot de passe de 10 caractères</span>";
    }

    //Je vérifie que $_SESSION à bien récupéré un utilisateur 
    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    } else {
        header('Location: connexion.php');
    }
}

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
    <title>TO DO LIST : Inscription</title>

    <link rel="stylesheet" href="./style/inscription.css">
</head>

<body>
    <header class="navbar">
        <nav class="navbar-content">
            <a href="http://localhost/TODOLIST/"><img src="./images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
            <ul class="navbar-links">
                <li class="navbar-link">
                    <a href="#">#</a>
                </li>
                <li class="navbar-link">
                    <a href="#">#</a>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form">
            <div class="form-container">
                <h1>Créer votre compte</h1>
                <div class="form-control">
                    <?= $message ?>
                </div>

                <form action="#" method="POST">
                    <div class="form-control">
                        <label for="login">Identfiant :</label>
                        <input type="text" name="login" id="login" , placeholder="identifiant" required>
                    </div>

                    <div class="form-control">
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" id="password" , placeholder="mot de passe" required>
                    </div>

                    <div class="form-control">
                        <input type="submit" class="form-button" value="CREER">
                    </div>
            </div>
            </form>

        </section>
    </main>



</body>

</html>