<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifiez si l'ID de la photo est passé en paramètre
if (isset($_GET['id'])) {
    $id_photo = $_GET['id'];

    // Récupérez les informations actuelles de la photo
    $sql = "SELECT * FROM Photo WHERE id_photo = '$id_photo'";
    $result = mysqli_query($conn, $sql);
    $photo = mysqli_fetch_assoc($result);

    // Vérifiez si la photo existe
    if (!$photo) {
        echo "<script>alert('Photo introuvable.'); window.location.href = 'photos.php';</script>";
        exit();
    }

    // Récupérez les séances pour la liste déroulante
    $sql_seances = "SELECT id_seance, lieu FROM Seance";
    $result2 = mysqli_query($conn, $sql_seances);
} else {
    // Si aucun ID n'est passé, afficher une alerte et rediriger vers la page des photos
    echo "<script>alert('Aucune photo spécifiée.'); window.location.href = 'photos.php';</script>";
    exit();
}

// Gestion de la soumission du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $resolution = $_POST['resolution'];
    $id_seance = $_POST['id_seance'];
    $nom_fichier = $_FILES['file']['name'];

    // Si un nouveau fichier est téléchargé
    if (!empty($nom_fichier)) {
        $chemin_temporaire = $_FILES['file']['tmp_name'];
        $dossier_cible = "../../uploads/photos/" . $nom_fichier;

        if (move_uploaded_file($chemin_temporaire, $dossier_cible)) {
            // Mise à jour des informations de la photo avec le nouveau fichier
            $sql_update = "UPDATE Photo 
                           SET nom_fichier = '$nom_fichier', resolution = '$resolution', id_seance = '$id_seance' 
                           WHERE id_photo = '$id_photo'";
        } else {
            echo "<script>alert('Erreur lors du téléchargement de l'image.');</script>";
        }
    } else {
        // Mise à jour sans nouveau fichier
        $sql_update = "UPDATE Photo 
                       SET resolution = '$resolution', id_seance = '$id_seance' 
                       WHERE id_photo = '$id_photo'";
    }

    // Exécuter la requête SQL et vérifier si elle a réussi
    if (mysqli_query($conn, $sql_update)) {
        // Afficher une alerte de succès et rediriger vers la page des photos
        echo "<script>alert('Photo mise à jour avec succès.'); window.location.href = 'photos.php';</script>";
    } else {
        // Afficher une alerte d'erreur
        echo "<script>alert('Erreur lors de la mise à jour de la photo.');</script>";
    }
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/sidebar.php"; // Inclusion de la barre latérale
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Modifier une Photo</h1>
    <div class="card">
        <div class="card-header">Modifier les informations de la photo</div>
        <div class="card-body">
            <form action="edit_photo.php?id=<?php echo $id_photo; ?>" method="post" enctype="multipart/form-data">
                <!-- Champ pour le fichier -->
                <div class="mb-3">
                    <label for="file" class="form-label">Changer l'image (laisser vide pour conserver l'actuelle) :</label>
                    <input type="file" id="file" name="file" class="form-control" accept="image/*">
                    <small>Fichier actuel : <?php echo $photo['nom_fichier']; ?></small>
                </div>

                <!-- Champ pour la résolution -->
                <div class="mb-3">
                    <label for="resolution" class="form-label">Résolution :</label>
                    <input type="text" id="resolution" name="resolution" class="form-control" placeholder="1920x1080" value="<?php echo $photo['resolution']; ?>">
                </div>

                <!-- Sélection de séance -->
                <div class="mb-3">
                    <label for="id_seance" class="form-label">Sélectionnez une séance :</label>
                    <select name="id_seance" id="id_seance" class="form-select" required>
                        <?php while ($row2 = mysqli_fetch_assoc($result2)): ?>
                            <option value="<?php echo $row2['id_seance']; ?>" <?php echo ($row2['id_seance'] == $photo['id_seance']) ? 'selected' : ''; ?>>
                                <?php echo $row2['lieu']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Bouton de soumission -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="photos.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
