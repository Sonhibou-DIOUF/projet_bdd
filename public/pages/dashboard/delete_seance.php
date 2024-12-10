<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_seance = $_GET['id'];

    // Validation de l'ID (s'assurer qu'il s'agit d'un nombre entier)
    if (!is_numeric($id_seance)) {
        echo "<script>
            alert('ID de séance invalide.');
            window.location.href = 'seances.php'; // Redirection vers la page des séances
        </script>";
        exit();
    }

    // Requête SQL préparée pour supprimer la séance
    $sql = "DELETE FROM Seance WHERE id_seance = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Lier l'ID à la requête préparée
        mysqli_stmt_bind_param($stmt, "i", $id_seance);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            // Si la suppression a réussi, afficher une alerte et rediriger vers la page des séances
            echo "<script>
                alert('Séance supprimée avec succès.');
                window.location.href = 'seances.php'; // Redirection vers la page des séances
            </script>";
        } else {
            // Si la suppression a échoué, afficher une alerte d'erreur
            echo "<script>
                alert('Erreur lors de la suppression de la séance.');
                window.location.href = 'seances.php';
            </script>";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Erreur lors de la préparation de la requête.');
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
