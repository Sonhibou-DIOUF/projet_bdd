<?php
include ("../connexion_bdd.php");

// Calculer le total des paiements reçus pour une séance spécifique :

$sql = "SELECT SUM(Transaction.montant) AS total_paiements 
FROM Transaction WHERE Transaction.id_seance = 4 AND 
Transaction.type_transaction = 'paiement' ";

//Récupérer les transactions (factures et paiements) pour un client spécifique, groupées par séance :
$sql1 ="SELECT Seance.id_seance, Transaction.type_transaction, 
Transaction.montant, Transaction.date_transaction  

FROM Seance 

JOIN Effectue ON Seance.id_seance = Effectue.id_seance 

JOIN Transaction ON Seance.id_seance = Transaction.id_seance 

WHERE Effectue.id_photographe = 3 

ORDER BY Seance.date_seance; ";
//
$result = mysqli_query($conn,$sql);
//
$result1 = mysqli_query($conn,$sql1);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "total_paiements: ".$row['total_paiements']."<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}

if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        echo "total_paiements: ".$row1['total_paiements']."<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}
mysqli_close($conn);
?>