<?php
include "../connexion_bdd.php";

// Récupérer toutes les séances réservées par un client spécifique :
$sql = "SELECT * FROM Client WHERE id_client = 5";
// Trouver toutes les photos prises par un photographe dans une période donnée :

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