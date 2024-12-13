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

    // Récupérer l'email du photographe pour savoir quel utilisateur supprimer
    $sql_get_email = "SELECT email FROM Photographe WHERE id_photographe = ?";
    if ($stmt = mysqli_prepare($conn, $sql_get_email)) {
        mysqli_stmt_bind_param($stmt, "i", $id_photographe);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($photographe = mysqli_fetch_assoc($result)) {
            $email_photographe = $photographe['email'];  // On récupère l'email du photographe

            // Requête SQL pour supprimer l'utilisateur dans la table Utilisateur
            $sql_delete_utilisateur = "DELETE FROM Utilisateurs WHERE email = ?";
            if ($stmt_utilisateur = mysqli_prepare($conn, $sql_delete_utilisateur)) {
                mysqli_stmt_bind_param($stmt_utilisateur, "s", $email_photographe);

                // Exécuter la suppression de l'utilisateur
                if (!mysqli_stmt_execute($stmt_utilisateur)) {
                    echo "<script>
                        alert('Erreur lors de la suppression de l\'utilisateur.');
                        window.location.href = 'photographes.php';
                    </script>";
                    exit();
                }

                // Fermer la requête de suppression de l'utilisateur
                mysqli_stmt_close($stmt_utilisateur);
            }
        } else {
            echo "<script>
                alert('Photographe introuvable.');
                window.location.href = 'photographes.php'; // Redirection vers la page des photographes
            </script>";
            exit();
        }

        // Fermer la requête pour récupérer l'email
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Erreur lors de la préparation de la requête.');
            window.location.href = 'photographes.php';
        </script>";
        exit();
    }

    // Requête SQL pour supprimer le photographe de la table Photographe
    $sql_delete_photographe = "DELETE FROM Photographe WHERE id_photographe = ?";
    if ($stmt = mysqli_prepare($conn, $sql_delete_photographe)) {
        mysqli_stmt_bind_param($stmt, "i", $id_photographe);

        // Exécuter la suppression du photographe
        if (mysqli_stmt_execute($stmt)) {
            // Si la suppression a réussi, afficher une alerte et rediriger vers la page des photographes
            echo "<script>
                alert('Photographe et utilisateur supprimés avec succès.');
                window.location.href = 'photographes.php'; // Redirection vers la page des photographes
            </script>";
        } else {
            // Si la suppression du photographe a échoué, afficher une alerte d'erreur
            echo "<script>
                alert('Erreur lors de la suppression du photographe.');
                window.location.href = 'photographes.php';
            </script>";
        }

        // Fermer la requête de suppression du photographe
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
