<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_photo = $_GET['id'];

    // Requête SQL pour supprimer la photo
    $sql = "DELETE FROM Photo WHERE id_photo = '$id_photo'";

    // Exécuter la requête SQL et vérifier si elle a réussi
    if (mysqli_query($conn, $sql)) {
        // Si la suppression a réussi, afficher une alerte et rediriger vers la page des photos
        echo "<script>
            alert('Photo supprimée avec succès.');
            window.location.href = 'photos.php'; // Redirection vers la page des photos
        </script>";
    } else {
        // Si la suppression a échoué, afficher une alerte d'erreur et rediriger vers la page des photos
        echo "<script>
            alert('Erreur lors de la suppression de la photo.');
            window.location.href = 'photos.php';
        </script>";
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des photos
    header("Location: seances.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($conn);

?>
