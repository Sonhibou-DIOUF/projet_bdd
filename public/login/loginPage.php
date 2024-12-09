<?php
// Inclusion du fichier pour la connexion à la base de données
include "connexion_bdd.php";
// Inclusion des composants de l'en-tête et de la barre de navigation
include "../composants/header.php";
include "../composants/navbar.php";

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
    // Redirige vers la page d'accueil si l'utilisateur est déjà connecté
    header('Location: ../index.php');
}

// Vérifie que les champs 'email' et 'mot_de_passe' ne sont pas vides
if (!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {
    // Vérifie que la méthode de la requête est POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];

        // Requête SQL pour vérifier l'utilisateur dans la base de données
        $sql = "SELECT * FROM utilisateurs WHERE email = '$email' AND mot_de_passe = '$mot_de_passe'";
        $result = mysqli_query($conn, $sql);

        // Vérifie si la requête retourne des résultats
        if ($result && $result->num_rows > 0) {
            // Récupérer le premier élément sous forme d'un tableau associatif
            $user = $result->fetch_assoc();

            // Stocke l'email dans la session
            $_SESSION['email'] = $email;
            $_SESSION['message'] = 'Vous êtes bien connectés';

            // Redirige l'utilisateur selon son rôle
            if ($user['role'] == "client") {
                $_SESSION['id_client'] = $user['id_utilisateur'];
                header('Location: ../pages/dashboard/dashboard_clients.php');
                exit();
            }
            if ($user['role'] == "admin") {
                $_SESSION['id_admin'] = $user['id_utilisateur'];
                echo $_SESSION['id_admin'];
                header('Location: ../pages/dashboard/dashboard.php');
                exit();
            } elseif ($user['role'] == "photographe") {
                $_SESSION['id_photographe'] = $user['id_utilisateur'];
                header('Location: ../pages/dashboard/dashboard_photographes.php');
                exit();
            } else {
                header('Location: ../index.php');
            }

            // Gestion des cookies pour mémoriser l'email de l'utilisateur
            setcookie(
                'email',
                $email, time() + 365 * 24 * 3600, "/"
            );

            // Vérifie si le cookie a été créé
            if (isset($_COOKIE['email'])) {
                echo "Un cookie a été reçu : " . $_COOKIE['email'];
            } else {
                echo "Aucun cookie n'est créé";
            }
        } else {
            // Si les informations de connexion sont incorrectes
            $_SESSION['message'] = "L'email ou le mot de passe est incorrect";
            header('Location: login.php');
        }
    }
}
?>

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
                        Pas encore inscrit ? <a href="inscription.php">Créer un compte</a>
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
