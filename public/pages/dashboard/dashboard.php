<?php
// Inclusion du fichier pour la connexion à la base de données
include "../../login/connexion_bdd.php";
// Inclusion des composants de l'en-tête, de la barre de navigation, de la barre latérale et des alertes
include "../../composants/header.php";
include "../../composants/navbar.php";
include "../../composants/sidebar.php";
include "../../composants/alert.php";

// Vérification de la méthode de la requête HTTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Insertion des données dans la table Utilisateurs avec le rôle d'admin
    $sql = "INSERT INTO Utilisateurs (email, mot_de_passe, role) VALUES ('$email', '$mot_de_passe', 'admin')";
    if (mysqli_query($conn, $sql)) {
        // Message de succès en cas d'insertion réussie
        $_SESSION['success'] = 'Admin ajouté avec succès';
    } else {
        // Message d'erreur en cas d'échec de l'insertion
        $_SESSION['error'] = 'Erreur lors de l\'ajout de l\'admin';
    }
}
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Bienvenue dans votre Tableau de Bord Admin</h1>
    <p>Sélectionner un onglet à gauche pour commencer</p>
    <!-- Formulaire d'ajout d'admin -->
    <div class="card mb-4">
        <div class="card-header">Ajouter un nouveau admin</div>
        <div class="card-body">
            <form action="dashboard.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email de l'admin" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
