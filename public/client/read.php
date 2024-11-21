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
$sql = "SELECT nom , email FROM client WHERE id_client = 284";
$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "nom: ".$row['nom']. "----email: ".  $row['email']. "<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}
mysqli_close($conn);
?>