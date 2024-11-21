<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';

//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_seance = $_POST['date_seance'];
    $heure = $_POST['heure'];
    $lieu = $_POST['lieu'];
    $sql = "INSERT INTO Seance (date_seance, heure, lieu) VALUES ('$date_seance', '$heure', '$lieu')";
    mysqli_query($conn, $sql);
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<head>
    <title>Seance</title>
    <meta charset="utf-8"></meta>
</head>
<body>

</body>
<form action="create.php" method="post">
    <div>
        <label for="date_seance">Date de la seance</label>
        <input type="date" id="date_seance" name="date_seance" placeholder="date_seance">
    </div>
    <div>
        <label for="heure">L'heure de la séance</label>
        <input type="time" id="heure" name="heure" placeholder="heure_seance">
    </div>
    <div>
        <label for="lieu">Lieu</label>
        <input type="text" id="lieu" name="lieu" placeholder="Lieu de la séance">
    </div>
    <div>
        <label for="soumetttre">Soumettre</label>
        <input type="submit" name="S'inscrire" value="Envoyer"></input>
    </div>

</form>