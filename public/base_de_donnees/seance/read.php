<?php
include "../connexion_bdd.php";

// Obtenir la liste des séances pour lesquelles aucune transaction n'a été émise :
$sql = "
SELECT 
    Seance.id_seance AS idSeance, 
    Seance.date_seance AS dateSeance 
FROM 
    Seance 
LEFT JOIN 
    Transaction 
ON 
    Seance.id_seance = Transaction.id_seance 
    AND Transaction.type_transaction = 'facture' 
WHERE 
    Transaction.id_transaction IS NULL;
";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Liste des séances: ".$row['idSeance']."<br>";
        echo "Liste des séances: ".$row['dateSeance']."<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}
mysqli_close($conn);
?>