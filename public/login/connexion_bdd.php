<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

// Active l'affichage de tous les rapports d'erreurs
error_reporting(E_ALL);
// Configure PHP pour afficher les erreurs à l'écran
ini_set('display_errors', 1);

// Informations de connexion à la base de données
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';

// Établit la connexion avec la base de données
$conn = mysqli_connect($servername, $username, $password, $database);

// Vérifie si la connexion a échoué
if ($conn->connect_error) {
    // Arrête le script et affiche un message d'erreur
    die('Erreur : ' . $conn->connect_error);
}

// Affiche un message de succès si la connexion est établie (désactivé)
// echo 'Connexion réussie';
?>
