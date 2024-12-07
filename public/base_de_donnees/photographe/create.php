<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $mot_de_passe =$_POST['mot_de_passe'];
    $sql = "INSERT INTO Photographe (nom, specialite, email, telephone) VALUES ('$nom', '$specialite', '$email', '$telephone')";
    mysqli_query($conn, $sql);
    $sql= "INSERT INTO utilisateurs (email, mot_de_passe) VALUES ('$email','$mot_de_passe')";
    mysqli_query($conn, $sql);
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<head>
    <title>Photographe</title>
    <meta charset="utf-8"></meta>
</head>
<body>

</body>
<form action="create.php" method="post">
    <div>
        <label for="nom">Nom</label>
        <input type="text" id="Nom" name="nom" placeholder="Nom du photographe">
    </div>
    <div>
        <label for="specialite">Specialite</label>
        <input type="text" id="specialite" name="specialite" placeholder="specialite du photographe">
    </div>
    <div>
        <label for="telephone">Téléphone</label>
        <input type="tel" id="telephone" name="telephone" placeholder="Téléphone du photographe">
    </div>
    <div>
        <label for="email">Email
        <input type="email" id="email" name="email" placeholder="Email du photographe">
        </label>
    </div>
    <div>
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="moot de passe">
    </div>
    <div>
        <label for="soumetttre">Soumettre</label>
        <input type="submit" name="S'inscrire" value="Envoyer"></input>
    </div>

</form>