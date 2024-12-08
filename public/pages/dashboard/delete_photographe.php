<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_photographe = $_GET['id'];

    // Requête SQL pour supprimer la séance
    $sql = "DELETE FROM Photographe WHERE id_photographe = '$id_photographe'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('photographe supprimé avec succès.');
            window.location.href = 'photographes.php'; // Redirection vers la page des photographes
        </script>";
    } else {
        echo "<script>
            alert('Erreur lors de la suppression du photographe.');
            window.location.href = 'photographes.php';
        </script>";
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des photographes
    header("Location: photographes.php");
    exit();
}

mysqli_close($conn);

?>