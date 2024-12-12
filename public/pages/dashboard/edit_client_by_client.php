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
            echo "<script>alert('Client introuvable.'); window.location.href = 'dashboard_clients.php';</script>";
            exit();
        }
        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erreur de connexion à la base de données.'); window.location.href = 'dashboard_clients.php';</script>";
        exit();
    }
}

else {
    // Si aucun ID n'est passé, afficher une alerte et rediriger vers la page des clients
    echo "<script>alert('Aucun client spécifié.'); window.location.href = 'dashboard_clients.php';</script>";
}

// Gestion de la soumission du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérification si l'email a été modifié
    $email_modified = $email !== $client['email'];

    // Mise à jour des informations dans la table Client avec une requête préparée
    $sql_update_client = "UPDATE Client 
                               SET nom = ?, email = ?, telephone = ?, adresse = ? 
                               WHERE id_client = ?";
    $stmt_update_client = mysqli_prepare($conn, $sql_update_client);
    if ($stmt_update_client) {
        // Lier les paramètres à la requête préparée
        mysqli_stmt_bind_param($stmt_update_client, "ssssi", $nom, $email, $telephone, $adresse, $id_client);

        // Exécuter la mise à jour
        $update_result = mysqli_stmt_execute($stmt_update_client);

        // Si la mise à jour du client réussie
        if ($update_result) {
            // Mise à jour du mot de passe dans la table Utilisateurs si un nouveau mot de passe est fourni
            if (!empty($mot_de_passe)) {
                // Hashage du mot de passe avant de le stocker
                $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                // Mise à jour du mot de passe dans la table Utilisateurs
                $sql_update_utilisateur = "UPDATE Utilisateurs 
                                           SET mot_de_passe = ? 
                                           WHERE email = ?";
                $stmt_update_utilisateur = mysqli_prepare($conn, $sql_update_utilisateur);
                if ($stmt_update_utilisateur) {
                    // Lier les paramètres
                    mysqli_stmt_bind_param($stmt_update_utilisateur, "ss", $hashed_password, $email);

                    // Exécuter la mise à jour du mot de passe
                    mysqli_stmt_execute($stmt_update_utilisateur);

                    // Fermer la requête préparée
                    mysqli_stmt_close($stmt_update_utilisateur);
                }
            }

            // Si l'email a été modifié, mettre à jour l'email dans la table Utilisateurs
            if ($email_modified) {
                $sql_update_email_utilisateur = "UPDATE Utilisateurs 
                                                 SET email = ? 
                                                 WHERE email = ?";
                $stmt_update_email_utilisateur = mysqli_prepare($conn, $sql_update_email_utilisateur);
                if ($stmt_update_email_utilisateur) {
                    // Lier les paramètres
                    mysqli_stmt_bind_param($stmt_update_email_utilisateur, "ss", $email, $client['email']);

                    // Exécuter la mise à jour de l'email
                    mysqli_stmt_execute($stmt_update_email_utilisateur);

                    // Fermer la requête préparée
                    mysqli_stmt_close($stmt_update_email_utilisateur);
                }
            }

            // Afficher une alerte de succès et rediriger vers le tableau de bord des clients
            echo "<script>alert('Client mis à jour avec succès.'); window.location.href = 'dashboard_clients.php';</script>";
        } else {
            // Afficher une alerte d'erreur en cas d'échec de la mise à jour
            echo "<script>alert('Erreur lors de la mise à jour du client.');</script>";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt_update_client);
    } else {
        echo "<script>alert('Erreur de mise à jour des informations du client.');</script>";
    }
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
?>

<!-- Main Content -->
<div class="container">
    <h1 class="mb-4">Modifier un Client</h1>
    <div class="card">
        <div class="card-header">Modifier les informations du client</div>
        <div class="card-body">
            <form action="edit_client_by_client.php?id=<?php echo $id_client; ?>" method="POST">
                <!-- Champ pour le nom -->
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom du client" value="<?php echo $client['nom']; ?>" required>
                </div>

                <!-- Champ pour l'email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email du client" value="<?php echo $client['email']; ?>" required>
                </div>

                <!-- Champ pour le téléphone -->
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Téléphone du client" value="<?php echo $client['telephone']; ?>" required>
                </div>

                <!-- Champ pour l'adresse -->
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Adresse du client" value="<?php echo $client['adresse']; ?>" required>
                </div>

                <!-- Champ pour le mot de passe -->
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe (laisser vide pour conserver l'actuel)</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Mot de passe">
                </div>

                <!-- Boutons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="dashboard_clients.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
