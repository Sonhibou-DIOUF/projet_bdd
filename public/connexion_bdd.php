<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';
//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
// Verifier la connexion
if (!$conn) {
die("Échec de la connexion : " . mysqli_connect_error());
}

?>