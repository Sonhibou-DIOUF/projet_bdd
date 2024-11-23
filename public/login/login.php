<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';
//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
// Verifier la connexion
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// creer une fonction login  :

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $mot_de_passe =$_POST['mot_de_passe'];
        $sql = "select email, mot_de_passe from utilisateurs where email = '$email' AND mot_de_passe = '$mot_de_passe'";
        $result =mysqli_query($conn,$sql);
        if($result->num_rows > 0){
            echo "Connexion reussie";
        }else{
            echo "Veuilez verifier votre email et votre mot de passe";
        }


}

// Verifie le couple email-motde passe exist dans BDD

// Creer une session avec les cookies

// redirige l'utilisateur vers son tableau de bord





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
        <form method="post" action="login.php">
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Your email">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="mot_de_passe" placeholder="Password">
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
