<?php
// Ici, l'objectif est d'établir une connexion entre le projet PHP et la BDD music
// Créer une instance de PDO pour se connecter 

$dsn = "mysql:host=localhost;dbname=music;charset=UTF8";
$user= "root";
$password="root";

try {
    $db_connexion = new PDO($dsn, $user, $password);
    $db_connexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    $db_connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<p>Impossible de se connecter à la base de données</p>';
}