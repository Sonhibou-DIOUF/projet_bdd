<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifiez si l'ID du photographe est passé en paramètre
if (isset($_GET['id'])) {
    $id_photographe = $_GET['id'];

    // Récupérez les informations actuelles du photographe avec une requête préparée
    $sql = "SELECT * FROM Photographe WHERE id_photographe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Lier l'ID du photographe en paramètre
        mysqli_stmt_bind_param($stmt, "i", $id_photographe);

        // Exécution de la requête
        mysqli_stmt_execute($stmt);

        // Récupérer le résultat
        $result = mysqli_stmt_get_result($stmt);
        $photographe = mysqli_fetch_assoc($result);

        // Vérifiez si le photographe existe
        if (!$photographe) {
            echo "<script>alert('Photographe introuvable.'); window.location.href = 'photographes.php';</script>";
            exit();
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erreur de connexion à la base de données.'); window.location.href = 'photographes.php';</script>";
        exit();
    }
} else {
    // Si aucun ID n'est passé, afficher une alerte et rediriger vers la page des photographes
    echo "<script>alert('Aucun photographe spécifié.'); window.location.href = 'photographes.php';</script>";
    exit();
}

// Gestion de la soumission du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Mise à jour des informations dans la table Photographe avec une requête préparée
    $sql_update_photographe = "UPDATE Photographe 
                               SET nom = ?, specialite = ?, telephone = ?, email = ? 
                               WHERE id_photographe = ?";
    $stmt_update_photographe = mysqli_prepare($conn, $sql_update_photographe);
    if ($stmt_update_photographe) {
        // Lier les paramètres à la requête préparée
        mysqli_stmt_bind_param($stmt_update_photographe, "ssssi", $nom, $specialite, $telephone, $email, $id_photographe);

        // Exécuter la mise à jour
        $update_result = mysqli_stmt_execute($stmt_update_photographe);

        // Si la mise à jour du photographe réussie
        if ($update_result) {
            // Mise à jour du mot de passe dans la table Utilisateurs si un nouveau mot de passe est fourni
            if (!empty($mot_de_passe)) {
                // Hashage du mot de passe avant de le stocker
                $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                // Mise à jour du mot de passe dans la table Utilisateurs
                $sql_update_utilisateur = "UPDATE utilisateurs 
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

            // Afficher une alerte de succès et rediriger vers le tableau de bord des photographes
            echo "<script>alert('Photographe mis à jour avec succès.'); window.location.href = 'dashboard_photographes.php';</script>";
        } else {
            // Afficher une alerte d'erreur en cas d'échec de la mise à jour
            echo "<script>alert('Erreur lors de la mise à jour du photographe.');</script>";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt_update_photographe);
    } else {
        echo "<script>alert('Erreur de mise à jour des informations du photographe.');</script>";
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
    <h1 class="mb-4">Modifier un Photographe</h1>
    <div class="card">
        <div class="card-header">Modifier les informations du photographe</div>
        <div class="card-body">
            <form action="edit_photographe.php?id=<?php echo $id_photographe; ?>" method="post">
                <!-- Champ pour le nom -->
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom du photographe" value="<?php echo $photographe['nom']; ?>" required>
                </div>

                <!-- Champ pour la spécialité -->
                <div class="mb-3">
                    <label for="specialite" class="form-label">Spécialité</label>
                    <input type="text" id="specialite" name="specialite" class="form-control" placeholder="Spécialité du photographe" value="<?php echo $photographe['specialite']; ?>" required>
                </div>

                <!-- Champ pour le téléphone -->
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Téléphone du photographe" value="<?php echo $photographe['telephone']; ?>" required>
                </div>

                <!-- Champ pour l'email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email du photographe" value="<?php echo $photographe['email']; ?>" required>
                </div>

                <!-- Champ pour le mot de passe -->
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe (laisser vide pour conserver l'actuel)</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Mot de passe">
                </div>

                <!-- Boutons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="dashboard_photographes.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
