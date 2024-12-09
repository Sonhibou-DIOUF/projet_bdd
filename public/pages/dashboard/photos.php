<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si la méthode de la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération du fichier téléchargé
    $chemin_fichier_tmp = $_FILES['file']['tmp_name'];
    $nom_fichier = $_FILES['file']['name'];

    // Déplacement du fichier vers le dossier "images/"
    $dossier_cible = "../../../ressources/images/";
    $chemin_fichier = $dossier_cible . basename($nom_fichier);

    // Vérifier si le fichier a été déplacé avec succès
    if (move_uploaded_file($chemin_fichier_tmp, $chemin_fichier)) {
        echo "<script>alert('Fichier uploadé avec succès !');</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'upload du fichier.');</script>";
    }

    // Récupération de la résolution et du format
    $resolution = $_POST['resolution'];
    $format = pathinfo($chemin_fichier, PATHINFO_EXTENSION); // Récupération de l'extension du fichier
    $id_seance = $_POST['id_seance'];

    // Insertion dans la base de données
    $sql = "INSERT INTO Photo (chemin_fichier, resolution, format, id_seance) 
            VALUES ('$chemin_fichier', '$resolution', '$format', '$id_seance')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Photo enregistrée dans la base de données.');</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'enregistrement : " . mysqli_error($conn) . "');</script>";
    }
}

// Récupération des séances pour le formulaire
$sql2 = "SELECT id_seance, lieu FROM Seance";
$result2 = mysqli_query($conn, $sql2);
?>

<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/sidebar.php"; // Inclusion de la barre latérale
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Gestion des Photos</h1>

    <!-- Formulaire d'ajout de photo -->
    <div class="card mb-4">
        <div class="card-header">Ajouter une nouvelle photo</div>
        <div class="card-body">
            <form action="photos.php" method="post" enctype="multipart/form-data">
                <!-- Champ pour le fichier -->
                <div class="mb-3">
                    <label for="file" class="form-label">Téléchargez une image :</label>
                    <input type="file" id="file" name="file" class="form-control" accept="image/*" required>
                </div>

                <!-- Champ pour la résolution -->
                <div class="mb-3">
                    <label for="resolution" class="form-label">Résolution :</label>
                    <input type="text" id="resolution" name="resolution" class="form-control" placeholder="1920x1080">
                </div>

                <!-- Sélection de séance -->
                <div class="mb-3">
                    <label for="id_seance" class="form-label">Sélectionnez une séance :</label>
                    <select name="id_seance" id="id_seance" class="form-select" required>
                        <?php foreach ($result2 as $row2): ?>
                            <option value="<?php echo $row2['id_seance']; ?>"><?php echo $row2['lieu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Bouton de soumission -->
                <div class="text-center">
                    <button type="submit" name="valider" value="Envoyer" class="btn btn-primary">Soumettre</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des photos -->
    <div class="card">
        <div class="card-header">Liste des photos</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Chemin</th>
                    <th>Résolution</th>
                    <th>Format</th>
                    <th>Id Séance</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM Photo";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row['id_photo']; ?></td>
                            <td><?php echo $row['chemin_fichier']; ?></td>
                            <td><?php echo $row['resolution']; ?></td>
                            <td><?php echo $row['format']; ?></td>
                            <td><?php echo $row['id_seance']; ?></td>
                            <td>
                                <a href="edit_photo.php?id=<?php echo $row['id_photo']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="delete_photo.php?id=<?php echo $row['id_photo']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endwhile; else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucune photo trouvée</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($conn);
?>
