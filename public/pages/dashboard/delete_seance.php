<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_seance = $_GET['id'];

    // Requête SQL pour supprimer la séance
    $sql = "DELETE FROM Seance WHERE id_seance = '$id_seance'";

    // Exécuter la requête SQL et vérifier si elle a réussi
    if (mysqli_query($conn, $sql)) {
        // Si la suppression a réussi, afficher une alerte et rediriger vers la page des séances
        echo "<script>
            alert('Séance supprimée avec succès.');
            window.location.href = 'seances.php'; // Redirection vers la page des séances
        </script>";
    } else {
        // Si la suppression a échoué, afficher une alerte d'erreur et rediriger vers la page des séances
        echo "<script>
            alert('Erreur lors de la suppression de la séance.');
            window.location.href = 'seances.php';
        </script>";
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des séances
    header("Location: seances.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($conn);

?>
