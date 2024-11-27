<?php
include "login.php"
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Connexion</h3>
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">Mot de Passe</label>
                            <input type="password" class="form-control" id="password" name="mot_de_passe" placeholder="Entrer votre mot de passe" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </form>
                    <p class="text-center mt-3">
Pas encore inscrit ? <a href="register.php">Créer un compte</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lien vers Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
