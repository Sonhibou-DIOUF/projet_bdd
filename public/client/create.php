<?php
include ("../connexion_bdd.php");
////////////////////////////////////////
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $mot_de_passe =$_POST['mot_de_passe'];
    $sql = "INSERT INTO client (nom, email,telephone, adresse) VALUES ('$nom','$email','$telephone','$adresse')";
    mysqli_query($conn, $sql);
    $sql= "INSERT INTO utilisateurs (email, mot_de_passe) VALUES ('$email','$mot_de_passe')";
    mysqli_query($conn, $sql);
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Bootstrap 5</title>
    <!-- Lien vers Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="https://via.placeholder.com/40" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            PicturMe
        </a>
        <!-- Bouton pour afficher/cacher le menu en mode mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">Inscription Client</h2>
    <form action="create.php" method="post">
        <div class="mb-3">
            <label for="Nom" class="form-label">Nom</label>
            <input type="text" id="Nom" name="nom" class="form-control" placeholder="Nom du client" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email du client" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Téléphone du client" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Adresse du client" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<!-- Lien vers Bootstrap 5 JS (optionnel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
