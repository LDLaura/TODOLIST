<?php
session_start();

//Verifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

//Import
require_once '../../service/db_connect.php';

$id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['id'])) {

    $request = 'DELETE FROM users WHERE id = :id';
    $stmt = $db_connexion->prepare($request);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
  
    header('Location: ../inscription.php');;
} else {
    echo "Oops! Une erreur est survenue !";
}
