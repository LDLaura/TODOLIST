<?php
session_start();
//Import
require_once 'service/db_connect.php';

// Création des constantes pour les erreurs
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'Le mot de passe ne répond pas aux nombres de caractères requis (10)';

// Création d'un tableau qui recevra les erreurs possibles
$errors = [
    'login' => '',
    'password' => ''
];
$message = '';

//Traitement des données si la méyhode du formulaire soumis est bien POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'login' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);
    //Initialisation des variables qui vont recevoir les datas des champs du formulaire
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    //Remplissage du tableau qui concerne les erreurs possibles
    if (!$login) {
        $errors['login'] = ERROR_REQUIRED;
    }
    if (!$passwd) {
        $errors['password'] = ERROR_REQUIRED;
    } elseif (mb_strlen($passwd) < 10) {
        $errors['password'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }

    //Exéctuer la requête SELECT
    if ((!empty($login)) && (!empty($password) && (mb_strlen($password) >= 10))) {
        // Verifier que l'utilisateur n'existe pas en BDD (avec SELECT)
        $sql = 'SELECT * FROM users
                    WHERE login = :login';
        if (isset($db_connexion)) {
            $db_statement = $db_connexion->prepare($sql);
        }
        $db_statement->execute(
            array(
                ':login' => $login
            )
        );
        $data = $db_statement->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $data['password'])) {
            $_SESSION['id'] = $data['id'];
            header('Location: monCompte.php');
        } else {
            $message = "<span class='message'>Le mot de passe est incorrect !</span>";
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs avec un mot de passe de 10 caractères</span>";
    }
}


?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
    <title>TO DO LIST : Connexion</title>

    <link rel="stylesheet" href="./style/connexion.css">
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
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form">
            <div class="form-container">
                <h1>Connectez-vous à votre compte</h1>
                <div class="form-control">
                    <?= $message ?>
                </div>

                <form action="#" method="POST">
                    <div class="form-control">
                        <label for="login">Identfiant :</label>
                        <input type="text" name="login" id="login" required>
                    </div>

                    <div class="form-control">
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="form-control">
                        <input type="submit" class="form-button" value="VALIDER">
                    </div>
            </div>
            </form>

        </section>
    </main>



</body>

</html>