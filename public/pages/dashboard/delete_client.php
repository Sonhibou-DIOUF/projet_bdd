<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Vérifier que l'ID est bien un nombre (validation de type)
    if (!is_numeric($id_client)) {
        echo "<script>
            alert('ID client invalide.');
            window.location.href = 'clients.php'; // Redirection vers la page des clients
        </script>";
        exit();
    }

    // Requête SQL préparée pour supprimer le client
    $sql = "DELETE FROM Client WHERE id_client = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Lier l'ID à la requête préparée
        mysqli_stmt_bind_param($stmt, "i", $id_client);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            // Si la suppression a réussi, afficher une alerte et rediriger vers la page des clients
            echo "<script>
                alert('Client supprimé avec succès.');
                window.location.href = 'clients.php'; // Redirection vers la page des clients
            </script>";
        } else {
            // Si la suppression a échoué, afficher une alerte d'erreur
            echo "<script>
                alert('Erreur lors de la suppression du client.');
                window.location.href = 'clients.php';
            </script>";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Erreur lors de la préparation de la requête.');
            window.location.href = 'clients.php';
        </script>";
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des clients
    header("Location: clients.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($conn);

?>
