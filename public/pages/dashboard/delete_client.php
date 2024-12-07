<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_seance = $_GET['id'];

    // Requête SQL pour supprimer la séance
    $sql = "DELETE FROM Client WHERE id_seance = '$id_client'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Séance supprimée avec succès.');
            window.location.href = 'clients.php'; // Redirection vers la page des clients
        </script>";
    } else {
        echo "<script>
            alert('Erreur lors de la suppression de la séance.');
            window.location.href = 'clients.php';
        </script>";
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des clients
    header("Location: clients.php");
    exit();
}

mysqli_close($conn);

?>
