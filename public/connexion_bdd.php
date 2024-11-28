<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = 'mysql.ensinfo.sciences.univ-nantes.prive';
$username = 'E240230U';
$password = 'XZD8RFGU';
$database = 'E240230U';
//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
// Verifier la connexion
if($conn->connect_error){
    die('Erreur : ' .$conn->connect_error);
}
echo 'Connexion réussie';
?>