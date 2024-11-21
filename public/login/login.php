<?php

// creer une fonction login  :
// recupère l'email et le mot de passe
// Verifie le couple email-motde passe exist dans BDD
// Creer une session avec les cookies
// redirige l'utilisateur vers son tableau de bord

function login($email, $password, $pdo)
{
    // Requête SQL pour récupérer l'utilisateur par email
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Vérifiez si l'utilisateur existe
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérifiez si le mot de passe correspond (hachage pris en charge)
        if (password_verify($password, $user['mot_de_passe'])) {
            // Démarrer une session et stocker des informations utilisateur
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_nom'] = $user['nom'];
            return "Connexion réussie !";
        } else {
            return "Mot de passe incorrect.";
        }
    } else {
        return "Utilisateur non trouvé.";
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../ressources/StyleLogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <form method="post" action="login()">
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Your email">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p> Don't have an account ?  <a href="#">Register</a></p>
            </div>

        </form>
    </div>



</body>
</html>
