<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_photographe = $_GET['id'];

    // Validation de l'ID (s'assurer qu'il s'agit d'un nombre entier)
    if (!is_numeric($id_photographe)) {
        echo "<script>
            alert('ID photographe invalide.');
            window.location.href = 'photographes.php'; // Redirection vers la page des photographes
        </script>";
        exit();
    }

    // Requête SQL préparée pour supprimer le photographe
    $sql = "DELETE FROM Photographe WHERE id_photographe = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Lier l'ID à la requête préparée
        mysqli_stmt_bind_param($stmt, "i", $id_photographe);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            // Si la suppression a réussi, afficher une alerte et rediriger vers la page des photographes
            echo "<script>
                alert('Photographe supprimé avec succès.');
                window.location.href = 'photographes.php'; // Redirection vers la page des photographes
            </script>";
        } else {
            // Si la suppression a échoué, afficher une alerte d'erreur
            echo "<script>
                alert('Erreur lors de la suppression du photographe.');
                window.location.href = 'photographes.php';
            </script>";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Erreur lors de la préparation de la requête.');
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
