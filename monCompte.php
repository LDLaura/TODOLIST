    <?php
    //Ouvrir la session pour pouvoir récupérer les valeurs sotckées dans $_SESSION
    session_start();

    //Vérifier que l'utilisateur soit connecté
    if (!isset($_SESSION['id'])) {
        header('Location: connexion.php');
    }

    //Import
    require_once 'service/db_connect.php';

    $request = 'SELECT title, content, createdAt FROM list';
    $stmt = $db_connexion->query($request);

    $listes = $stmt->fetchAll();
    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Simplifiez votre vie et n'oubliez plus rien avec TODOLIST">
        <title>TO DO LIST : Mon compte</title>

        <link rel="stylesheet" href="./style/monCompte.css">
    </head>

    <body>
        <header class="navbar">
            <nav class="navbar-content">
                <a href="http://localhost/TODOLIST/"><img src="./images/logo-notes.png" alt="Ce logo représente une forme oval marron avec écrit dessus Notes" class="navbar-logo"></a>
                <ul class="navbar-links">
                    <li class="navbar-link">
                        <a href="ajouterList.php">Ajouter</a>
                    </li>
                    <li class="navbar-link">
                        <a href="#">Modifier</a>
                </ul>
            </nav>
        </header>

        <main>
            <section class="main-content">
                <h2>Mes dernières To Do List :</h2>
                <table>
                    <tr>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date de création</th>
                        <th></th>
                    </tr>

                    <?php
                    foreach ($listes as $liste) {
                        echo '<tr>';

                        foreach ($liste as $valeur) {
                            echo '<td> ' . $valeur . ' </td>';
                            
                        }

                        echo '</tr>';
                        echo '<td><button type="submit">Modifier</button></td>';
                    }
                    ?>
                </table>
            </section>

        </main>

    </body>

    </html>