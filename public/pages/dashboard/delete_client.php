<?php

include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Requête SQL pour supprimer le client
    $sql = "DELETE FROM Client WHERE id_client = '$id_client'";

    // Exécuter la requête SQL et vérifier si elle a réussi
    if (mysqli_query($conn, $sql)) {
        // Si la suppression a réussi, afficher une alerte et rediriger vers la page des clients
        echo "<script>
            alert('Client supprimé avec succès.');
            window.location.href = 'clients.php'; // Redirection vers la page des clients
        </script>";
    } else {
        // Si la suppression a échoué, afficher une alerte d'erreur et rediriger vers la page des clients
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

// Fermer la connexion à la base de données
mysqli_close($conn);

?>
