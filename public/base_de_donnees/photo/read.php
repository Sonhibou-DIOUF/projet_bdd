<?php
include "../connexion_bdd.php";
// RTrouver toutes les photos prises par un photographe dans une période donnée

$sql = "SELECT Photo.chemin_fichier AS chemin_fichier,
Seance.date_seance AS date_seance 

FROM Photo 

JOIN Seance ON Photo.id_seance = Seance.id_seance 

WHERE Seance.id_photographe = 4 AND Seance.date_seance BETWEEN '2024-12-09' AND '2024-12-10'";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "chemin_fichier: ".$row['chemin_fichier']. "******"."date_seance". $row['date_seance']. "<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}
mysqli_close($conn);
?>
