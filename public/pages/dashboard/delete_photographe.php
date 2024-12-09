<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_photographe = $_GET['id'];

    // Requête SQL pour supprimer le photographe
    $sql = "DELETE FROM Photographe WHERE id_photographe = '$id_photographe'";

    // Exécuter la requête SQL et vérifier si elle a réussi
    if (mysqli_query($conn, $sql)) {
        // Si la suppression a réussi, afficher une alerte et rediriger vers la page des photographes
        echo "<script>
            alert('Photographe supprimé avec succès.');
            window.location.href = 'photographes.php'; // Redirection vers la page des photographes
        </script>";
    } else {
        // Si la suppression a échoué, afficher une alerte d'erreur et rediriger vers la page des photographes
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

// Fermer la connexion à la base de données
mysqli_close($conn);

?>
