<?php
// session_start();
include "../connexion_bdd.php";

// creer une fonction login  :

    if(!empty($_POST['email']) && !empty($_POST['mot_de_passe'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST['email'];
            $mot_de_passe =$_POST['mot_de_passe'];
            $sql = "select email, mot_de_passe from utilisateurs where email = '$email' AND mot_de_passe = '$mot_de_passe'";
            $result =mysqli_query($conn,$sql);
            if($result->num_rows > 0){
                // cookie email et mot de passe // securisé
                setcookie(
                    'email',
                    $email, time() + 365*24*3600, "../"
                );
                
                // verification de l'envoi du cookie
                if(isset($_COOKIE['email'])){
                    echo "un cookie a été recu". $_COOKIE['email'];
                    echo "son nom est email";
                }else {
                    echo "aucun cookie n'est créer";
                }
                // session
                // $_SESSION['email'] = $email;

                header('location: ../index.php');
                echo "Vous etes connecté !";
            }else{
                echo "email ou mot de passe incorrect !";
            }


        }
    }




// Verifie le couple email-motde passe exist dans BDD

// Creer une session avec les cookies

// redirige l'utilisateur vers son tableau de bord

?>

