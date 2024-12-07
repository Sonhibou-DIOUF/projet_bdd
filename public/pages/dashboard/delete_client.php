<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Requête SQL pour supprimer la séance
    $sql = "DELETE FROM Client WHERE id_client = '$id_client'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Client supprimé avec succès.');
            window.location.href = 'clients.php'; // Redirection vers la page des clients
        </script>";
    } else {
        echo "<script>
            alert('Erreur lors de la suppression du client.');
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
