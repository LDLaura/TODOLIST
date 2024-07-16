<?php
session_start();

//Verifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once 'service/db_connect.php';

$idListe = $_GET['idListe'];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idListe'])) {

    $request = 'DELETE FROM list WHERE idListe = :idListe';
    $stmt = $db_connexion->prepare($request);
    $stmt->bindParam(':idListe', $idListe);

    $stmt->execute();
  
    header('Location: monCompte.php');
} else {
    echo "Oops! Une erreur est survenue !";
}


