
<?php
include "../connexion_bdd.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $sql = "INSERT INTO Client (nom, email) VALUES ('$nom', '$email')";
    mysqli_query($conn, $sql);
    if (isset($))
        if (empty($nom)) {
            echo "Champ nom n'est pas valide";
        }
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
    <label for="Nom">Nom</label>
    <input type="text" id="Nom" name="nom" placeholder="Nom de la personne">
    <label for="email">email</label>
    <input type="email" id="email" name="email" placeholder="Email de la personne">
    <label for="telephone">telephone</label>
    <input type="tel" id="telephone" name="telephone" placeholder="Telephone du client"
    <input type="submit" name="S'inscrire" value="créer un client"></input>



</form>