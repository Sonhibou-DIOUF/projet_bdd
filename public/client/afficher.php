<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';

//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $$query = "SELECT nom FROM Client WHERE id_client = 284";
    $result = mysqli_query($conn,$query);
    echo $result;
    mysqli_query($conn, $sql);
}



mysqli_close($conn);
?>
<!DOCTYPE html>
<head>
    <title> Creation de Client</title>
    <meta charset="utf-8"></meta>
</head>
<body>

</body>
<form action="creer.php" method="post">
    <div>
        <label for="Nom">Nom</label>
        <input type="text" id="Nom" name="nom" placeholder="Nom du client">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email du client">
    </div>
    <div>
        <label for="telephone">Téléphone</label>
        <input type="tel" id="telephone" name="telephone" placeholder="Téléphone du client">
    </div>
    <div>
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse", name="adresse" placeholder="adresse du client">
    </div>
    <div>
        <label for="soumetttre">Soumettre</label>
        <input type="submit" name="S'inscrire" value="Envoyer"></input>
    </div>

</form>