<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifiez si l'ID du client est passé en paramètre
if (isset($_GET['id'])) {
    $id_photographe = $_GET['id'];

    // Récupérez les informations du client
    $sql = "SELECT * FROM Photographe WHERE id_photographe = '$id_photographe'";
    $result = mysqli_query($conn, $sql);
    $photographe = mysqli_fetch_assoc($result);

    if (!$photographe) {
        echo "<script>alert('Photographe introuvable.'); window.location.href = 'photographes.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Aucun photographe spécifié.'); window.location.href = 'photographes.php';</script>";
    exit();
}

// Gestion de la soumission du formulaire pour la modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];


    // Mise à jour des informations du client
    $sql_update = "UPDATE Photographe 
                   SET nom = '$nom', specialite = '$specialite', email = '$email', telephone = '$telephone' 
                   WHERE id_photographe = '$id_photographe'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Photographe mis à jour avec succès.'); window.location.href = 'photographes.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de la mise à jour du client.'); window.location.href = 'edit_photographe.php$id_photographe';</script>";
    }
}

mysqli_close($conn);
?>

<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/sidebar.php";
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Modifier un Photographe</h1>
    <div class="card">
        <div class="card-header">Modifier les informations du photographe</div>
        <div class="card-body">
            <form action="photographes.php?id=<?php echo $id_photographe; ?>" method="post">
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
                    <a href="photographes.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
