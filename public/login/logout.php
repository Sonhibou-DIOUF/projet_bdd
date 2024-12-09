<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

// Vide toutes les variables de session pour déconnecter l'utilisateur
$_SESSION = [];

// Redirige l'utilisateur vers la page d'accueil
header('location: ../index.php');
?>
