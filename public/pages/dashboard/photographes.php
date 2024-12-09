<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifiez si la méthode de la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Insertion dans la table Photographe
    $sql_photographe = "INSERT INTO Photographe (nom, specialite, email, telephone) 
                        VALUES ('$nom', '$specialite', '$email', '$telephone')";
    mysqli_query($conn, $sql_photographe);

    // Insertion dans la table Utilisateurs
    $sql_utilisateur = "INSERT INTO utilisateurs (email, mot_de_passe, role) 
                        VALUES ('$email', '$mot_de_passe', 'photographe')";
    mysqli_query($conn, $sql_utilisateur);

    // Afficher un message de succès
    echo "<script>alert('Photographe ajouté avec succès.');</script>";
}

// Récupération des photographes
$sql_photographes = "SELECT * FROM Photographe";
$result_photographes = mysqli_query($conn, $sql_photographes);

?>

<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
include "../../composants/sidebar.php"; // Inclusion de la barre latérale
?>
<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Gestion des Photographes</h1>

    <!-- Formulaire d'ajout de photographe -->
    <div class="card mb-4">
        <div class="card-header">Ajouter un nouveau photographe</div>
        <div class="card-body">
            <form action="photographes.php" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom du photographe" required>
                </div>
                <div class="mb-3">
                    <label for="specialite" class="form-label">Spécialité</label>
                    <input type="text" id="specialite" name="specialite" class="form-control" placeholder="Spécialité du photographe" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Téléphone du photographe" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email du photographe" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des photographes -->
    <div class="card">
        <div class="card-header">Liste des Photographes</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Spécialité</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($result_photographes->num_rows > 0): ?>
                    <?php while ($row = $result_photographes->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_photographe']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['specialite']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td>
                                <a href="edit_photographe.php?id=<?php echo $row['id_photographe']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="delete_photographe.php?id=<?php echo $row['id_photographe']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce photographe ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucun photographe trouvé</td>
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
mysqli_close($conn); // Fermer la connexion à la base de données
?>
