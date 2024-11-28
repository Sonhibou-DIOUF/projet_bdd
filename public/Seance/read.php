<?php
include "../connexion_bdd.php";

// Requete sql

$sql = "SELECT nom , email FROM client WHERE id_client = 284";
$sql1 = "SELECT nom , email FROM client WHERE id_client = 284";
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