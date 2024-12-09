<?php
// Inclusion du fichier pour la connexion à la base de données
include "connexion_bdd.php";

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
        $sql = "SELECT * FROM Utilisateurs WHERE email = '$email' AND mot_de_passe = '$mot_de_passe'";
        $result = mysqli_query($conn, $sql);

        // Vérifie si la requête retourne des résultats
        if ($result && $result->num_rows > 0) {
            // Récupère le premier résultat sous forme de tableau associatif
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

// Verifie le couple email-motde passe exist dans BDD

// Creer une session avec les cookies

// Redirige l'utilisateur vers son tableau de bord

?>
