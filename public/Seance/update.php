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
$query = "UPDATE Seance SET nom = 'NAFI' WHERE id_client = 284";
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else {
    echo 'erreur' . mysqli_error($conn);
}
mysqli_close($conn);

?>