<?php
// Inclusion du fichier pour la connexion à la base de données
include "connexion_bdd.php";


// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
    // Redirige vers la page d'accueil si l'utilisateur est déjà connecté
    header('Location: ../index.php');
    exit();
}

// Vérifie que les champs 'email' et 'mot_de_passe' ne sont pas vides
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et validation des données du formulaire
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    // Vérifie si les champs sont valides
    if (!$email) {
        $_SESSION['message'] = "Adresse e-mail invalide.";
        header('Location: loginPage.php');
        exit();
    }

    if (empty($mot_de_passe)) {
        $_SESSION['message'] = "Le mot de passe ne peut pas être vide.";
        header('Location: loginPage.php');
        exit();
    }

    // Prépare une requête sécurisée pour récupérer l'utilisateur
    $sql = "SELECT * FROM Utilisateurs WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Associe les paramètres et exécute la requête
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        // Récupère les résultats
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            // Récupère les données de l'utilisateur
            $user = mysqli_fetch_assoc($result);

            // Vérifie le mot de passe
            if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
                // Stocke les informations utilisateur dans la session
                $_SESSION['email'] = $email;
                $_SESSION['message'] = 'Vous êtes bien connectés';

                // Redirige l'utilisateur selon son rôle
                if ($user['role'] == "client") {
                    $_SESSION['id_client'] = $user['id_utilisateur'];
                    header('Location: ../pages/dashboard/dashboard_clients.php');
                    exit();
                } elseif ($user['role'] == "admin") {
                    $_SESSION['id_admin'] = $user['id_utilisateur'];
                    header('Location: ../pages/dashboard/dashboard.php');
                    exit();
                } elseif ($user['role'] == "photographe") {
                    $_SESSION['id_photographe'] = $user['id_utilisateur'];
                    header('Location: ../pages/dashboard/dashboard_photographes.php');
                    exit();
                } else {
                    // Si le rôle est invalide, redirige vers la page d'accueil
                    $_SESSION['message'] = "Rôle utilisateur inconnu.";
                    header('Location: ../index.php');
                    exit();
                }
            } else {
                // Si le mot de passe est incorrect
                $_SESSION['message'] = "Mot de passe incorrect.";
                header('Location: loginPage.php');
                exit();
            }
        } else {
            // Si l'utilisateur n'existe pas
            $_SESSION['message'] = "Aucun utilisateur trouvé avec cet email.";
            header('Location: loginPage.php');
            exit();
        }

        // Ferme la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        // Gestion des erreurs si la requête préparée échoue
        $_SESSION['message'] = "Une erreur système s'est produite. Veuillez réessayer plus tard.";
        header('Location: loginPage.php');
        exit();
    }
} else {
    // Si la requête n'est pas de type POST
    $_SESSION['message'] = "Requête non valide.";
    header('Location: loginPage.php');
    exit();
}

// Ferme la connexion à la base de données
mysqli_close($conn);
?>
