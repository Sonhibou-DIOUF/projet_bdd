<?php
include "../connexion_bdd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chemin_fichier = $_FILES['file']['tmp_name'];
    // je recupère le nom de l'image et je concatene avec le dossier image/"nom_du_fichier"

    // je recupère l'extention du fichier depuis l'image et je le garde dans la bdd en tant k format
    $resolution = $_POST['resolution'];
    $format = $_FILES['file']['type'];
    $format = explode('/', $format)[1];

    $sql = "INSERT INTO Photo (chemin_fichier, resolution, format, id_seance) VALUES ('$chemin_fichier','$resolution', '$format', 1) ";
    if (mysqli_query($conn, $sql)) {
        echo "Fichier enregistré dans la base de données.";
    }else{
    echo "Erreur : " . mysqli_error($conn);
    }
}
include "../header.php";
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Téléchargez une Image</h1>
    <form action="create.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light">
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
            <select name="id_seance" id="id_seance" class="form-select">
                <?php
                // Exemple de récupération des données de séance
                $sql2 = "SELECT id_seance, lieu FROM Seance";
                $result2 = mysqli_query($conn, $sql2);
                foreach ($result2 as $row2) {
                    echo "<option value='" . $row2['id_seance'] . "'>" . $row2['lieu'] . "</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" name="valider" value="Envoyer" class="btn btn-primary">Soumettre</button>
        </div>
    </form>
</div>
</body>
</html>