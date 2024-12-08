<?php
// Inclusion du fichier pour la connexion à la base de données
include "connexion_bdd.php";
// Inclusion des composants de l'en-tête et de la barre de navigation
include "../composants/header.php";
include "../composants/navbar.php";

// Vérification de la méthode de la requête HTTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $adresse = $_POST['adresse'];
    $role = $_POST['role']; // Rôle choisi : client ou photographe

    // Vérification du rôle choisi
    if ($role == "client") {
        // Insertion des données dans la table Client
        $sql_client = "INSERT INTO Client (nom, email, telephone, adresse) VALUES ('$nom', '$email', '$telephone', '$adresse')";
        if (mysqli_query($conn, $sql_client)) {
            // Récupération de l'identifiant du client inséré
            $id_client = mysqli_insert_id($conn);
            // Insertion des données dans la table utilisateurs
            $sql_utilisateur = "INSERT INTO utilisateurs (email, mot_de_passe, role) VALUES ('$email', '$mot_de_passe', 'client')";
            mysqli_query($conn, $sql_utilisateur);
            // Message de succès et redirection vers le tableau de bord des clients
            $_SESSION['message'] = "Compte client créé avec succès !";
            $_SESSION['id_client'] = $id_client;
            header('location: ../pages/dashboard/dashboard_clients.php');
        } else {
            // Message d'erreur en cas d'échec de l'insertion
            $_SESSION['error'] = "Erreur lors de la création du compte client.";
        }
    } elseif ($role == "photographe") {
        // Récupération de la spécialité pour le photographe
        $specialite = $_POST['specialite'];

        // Insertion des données dans la table Photographe
        $sql_photographe = "INSERT INTO Photographe (nom, email, telephone, specialite) VALUES ('$nom', '$email', '$telephone', '$specialite')";
        if (mysqli_query($conn, $sql_photographe)) {
            // Récupération de l'identifiant du photographe inséré
            $id_photographe = mysqli_insert_id($conn);
            // Insertion des données dans la table utilisateurs
            $sql_utilisateur = "INSERT INTO utilisateurs (email, mot_de_passe, role) VALUES ('$email', '$mot_de_passe', 'photographe')";
            mysqli_query($conn, $sql_utilisateur);
            // Message de succès et redirection vers le tableau de bord des photographes
            $_SESSION['message'] = "Compte photographe créé avec succès !";
            $_SESSION['id_photographe'] = $id_photographe;
            header('location: ../pages/dashboard/dashboard_photographes.php');
        } else {
            // Message d'erreur en cas d'échec de l'insertion
            $_SESSION['error'] = "Erreur lors de la création du compte photographe.";
        }
    } else {
        // Message d'erreur en cas de rôle invalide
        $_SESSION['error'] = "Rôle invalide.";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Inscription</h1>

    <!-- Messages d'erreur ou de succès -->
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php elseif (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire d'inscription -->
    <form action="inscription.php" method="post">
        <!-- Nom -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" required>
        </div>

        <!-- Téléphone -->
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Votre numéro de téléphone" required>
        </div>

        <!-- Mot de passe -->
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Votre mot de passe" required>
        </div>

        <!-- Rôle -->
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" id="role" class="form-select" required>
                <option value="">-- Choisissez votre rôle --</option>
                <option value="client">Client</option>
                <option value="photographe">Photographe</option>
            </select>
        </div>

        <!-- Spécialité (pour les photographes uniquement) -->
        <div class="mb-3" id="specialite-container" style="display: none;">
            <label for="specialite" class="form-label">Spécialité</label>
            <input type="text" id="specialite" name="specialite" class="form-control" placeholder="Votre spécialité">
        </div>

        <!-- Adresse (pour les clients uniquement) -->
        <div class="mb-3" id="adresse-container" style="display: none;">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Votre adresse">
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Créer un compte</button>
        </div>
    </form>
</div>

<script>
    // Afficher/masquer le champ spécialité en fonction du rôle
    document.getElementById('role').addEventListener('change', function () {
        const specialiteContainer = document.getElementById('specialite-container');
        const adresseContainer = document.getElementById('adresse-container');
        if (this.value === 'photographe') {
            specialiteContainer.style.display = 'block';
            adresseContainer.style.display = 'none';
        } else {
            specialiteContainer.style.display = 'none';
            adresseContainer.style.display = 'block';
        }
    });
</script>
</body>
</html>
