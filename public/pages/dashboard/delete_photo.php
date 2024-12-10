<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_photo = $_GET['id'];

    // Validation de l'ID (s'assurer qu'il s'agit d'un nombre entier)
    if (!is_numeric($id_photo)) {
        echo "<script>
            alert('ID photo invalide.');
            window.location.href = 'photos.php'; // Redirection vers la page des photos
        </script>";
        exit();
    }

    // Requête SQL préparée pour supprimer la photo
    $sql = "DELETE FROM Photo WHERE id_photo = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Lier l'ID à la requête préparée
        mysqli_stmt_bind_param($stmt, "i", $id_photo);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            // Si la suppression a réussi, afficher une alerte et rediriger vers la page des photos
            echo "<script>
                alert('Photo supprimée avec succès.');
                window.location.href = 'photos.php'; // Redirection vers la page des photos
            </script>";
        } else {
            // Si la suppression a échoué, afficher une alerte d'erreur
            echo "<script>
                alert('Erreur lors de la suppression de la photo.');
                window.location.href = 'photos.php';
            </script>";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Erreur lors de la préparation de la requête.');
            window.location.href = 'photos.php';
        </script>";
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des photos
    header("Location: photos.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($conn);

?>
