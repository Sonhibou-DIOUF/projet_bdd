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

    // Récupérer l'email du client pour savoir quel utilisateur supprimer
    $sql_get_email = "SELECT email FROM Client WHERE id_client = ?";
    if ($stmt = mysqli_prepare($conn, $sql_get_email)) {
        mysqli_stmt_bind_param($stmt, "i", $id_client);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($client = mysqli_fetch_assoc($result)) {
            $email_client = $client['email'];  // On récupère l'email du client

            // Requête SQL pour supprimer l'utilisateur dans la table Utilisateur
            $sql_delete_utilisateur = "DELETE FROM Utilisateurs WHERE email = ?";
            if ($stmt_utilisateur = mysqli_prepare($conn, $sql_delete_utilisateur)) {
                mysqli_stmt_bind_param($stmt_utilisateur, "s", $email_client);

                // Exécuter la suppression de l'utilisateur
                if (!mysqli_stmt_execute($stmt_utilisateur)) {
                    echo "<script>
                        alert('Erreur lors de la suppression de l\'utilisateur.');
                        window.location.href = 'clients.php';
                    </script>";
                    exit();
                }

                // Fermer la requête de suppression de l'utilisateur
                mysqli_stmt_close($stmt_utilisateur);
            }
        } else {
            echo "<script>
                alert('Client introuvable.');
                window.location.href = 'clients.php'; // Redirection vers la page des clients
            </script>";
            exit();
        }

        // Fermer la requête pour récupérer l'email
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Erreur lors de la préparation de la requête.');
            window.location.href = 'clients.php';
        </script>";
        exit();
    }

    // Requête SQL pour supprimer le client de la table Client
    $sql_delete_client = "DELETE FROM Client WHERE id_client = ?";
    if ($stmt = mysqli_prepare($conn, $sql_delete_client)) {
        mysqli_stmt_bind_param($stmt, "i", $id_client);

        // Exécuter la suppression du client
        if (mysqli_stmt_execute($stmt)) {
            // Si la suppression a réussi, afficher une alerte et rediriger vers la page des clients
            echo "<script>
                alert('Client et utilisateur supprimés avec succès.');
                window.location.href = 'clients.php'; // Redirection vers la page des clients
            </script>";
        } else {
            // Si la suppression du client a échoué, afficher une alerte d'erreur
            echo "<script>
                alert('Erreur lors de la suppression du client.');
                window.location.href = 'clients.php';
            </script>";
        }

        // Fermer la requête de suppression du client
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
