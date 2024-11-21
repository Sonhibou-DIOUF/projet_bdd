<?php
include ("../connexion_bdd.php");

$sql = "SELECT date_seance , lieu FROM Transaction WHERE id_client = 284";
$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "date_seance: ".$row['date_seance']. "----lieu: ".  $row['lieu']. "<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}
mysqli_close($conn);
?>