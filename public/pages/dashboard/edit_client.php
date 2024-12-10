<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifiez si l'ID du client est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Requête préparée pour éviter les injections SQL
    $sql = "SELECT * FROM Client WHERE id_client = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Lier l'ID du client comme paramètre
        mysqli_stmt_bind_param($stmt, "i", $id_client);

        // Exécution de la requête
        mysqli_stmt_execute($stmt);

        // Récupérer le résultat
        $result = mysqli_stmt_get_result($stmt);
        $client = mysqli_fetch_assoc($result);

        // Vérifiez si le client existe
        if (!$client) {
            echo "<script>alert('Client introuvable.'); window.location.href = 'clients.php';</script>";
            exit();
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erreur de connexion à la base de données.'); window.location.href = 'clients.php';</script>";
        exit();
    }
} else {
    // Si aucun ID n'est passé, afficher une alerte et rediriger vers la page des clients
    echo "<script>alert('Aucun client spécifié.'); window.location.href = 'clients.php';</script>";
    exit();
}
?>
