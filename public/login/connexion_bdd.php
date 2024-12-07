<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';
//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
// Verifier la connexion
if($conn->connect_error){
    die('Erreur : ' .$conn->connect_error);
}
// echo 'Connexion réussie';
?>