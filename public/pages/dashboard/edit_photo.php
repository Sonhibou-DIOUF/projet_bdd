<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifiez si l'ID de la photo est passé en paramètre
if (isset($_GET['id'])) {
    $id_photo = $_GET['id'];

    // Requête préparée pour récupérer les informations de la photo
    $sql = "SELECT * FROM Photo WHERE id_photo = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Lier l'ID de la photo comme paramètre
        mysqli_stmt_bind_param($stmt, "i", $id_photo);

        // Exécution de la requête
        mysqli_stmt_execute($stmt);

        // Récupérer le résultat
        $result = mysqli_stmt_get_result($stmt);
        $photo = mysqli_fetch_assoc($result);

        // Vérifiez si la photo existe
        if (!$photo) {
            echo "<script>alert('Photo introuvable.'); window.location.href = 'photos.php';</script>";
            exit();
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erreur de connexion à la base de données.'); window.location.href = 'photos.php';</script>";
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
                    <small>Fichier actuel : <?php echo $photo['chemin_fichier']; ?></small>
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
