<?php
include "connexion_bdd.php";

// creer une fonction login  :
if (isset($_SESSION['email'])) {
    header('Location: ../index.php');
}
if(!empty($_POST['email']) && !empty($_POST['mot_de_passe'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $sql = "SELECT * FROM utilisateurs WHERE email = '$email' AND mot_de_passe = '$mot_de_passe'";
        $result = mysqli_query($conn, $sql);

        if($result && $result->num_rows > 0){
            // Récupérer le premier élément sous forme d'un tableau associatif
            $user = $result->fetch_assoc();

            $_SESSION['email'] = $email;
            $_SESSION['message'] = 'Vous êtes bien connectés';

            if($user['role'] == "client"){
                $_SESSION['id_client'] = $user['id_utilisateur'];
                header('Location: ../pages/dashboard/dashboard_clients.php');
                exit();
            }
            if($user['role'] == "admin"){
                $_SESSION['id_admin'] = $user['id_utilisateur'];
                echo $_SESSION['id_admin'];
                header('Location: ../pages/dashboard/dashboard.php');
                exit();
            }
            elseif ($user['role'] == "photographe"){
                $_SESSION['id_photographe'] = $user['id_utilisateur'];
                header('Location: ../pages/dashboard/dashboard_photographes.php');
                exit();
            } else {
                header('Location: ../index.php');

            }

            // Gestion des cookies
            setcookie(
                'email',
                $email, time() + 365*24*3600, "/"
            );

            if(isset($_COOKIE['email'])){
                echo "Un cookie a été reçu : " . $_COOKIE['email'];
            } else {
                echo "Aucun cookie n'est créé";
            }
        } else {
            $_SESSION['message'] = "L'email ou le mot de passe est incorrect";
            header('Location: login.php');
        }
    }
}



// Verifie le couple email-motde passe exist dans BDD

// Creer une session avec les cookies

// redirige l'utilisateur vers son tableau de bord

?>

