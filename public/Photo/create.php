<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';

//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chemin_fichier = $_POST['file'];
    $resolution = $_POST['resolution'];
    $format = $_POST['format'];
    $sql = "INSERT INTO Photo (chemin_fichier, resolution, format) VALUES ('$chemin_fichier','$resolution', '$format') ";
    if (mysqli_query($conn, $sql)) {
        echo "Fichier enregistré dans la base de données.";
    }else{
    echo "Erreur : " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="fr"> <!-- Ajout de l'attribut de langue -->
<head>
    <meta charset="UTF-8"> <!-- Correction de la balise meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Vue responsive -->
    <title>Photo</title>
</head>
<body>
<form action="create.php" method="post" enctype="multipart/form-data"> <!-- Ajout de enctype pour gérer les fichiers -->
    <div>
        <label for="file">Téléchargez une image :</label>
        <input type="file" id="file" name="file" accept=".jpeg, .jpg, .png, .gif" required>
    </div>
    <div>
        <label for="resolution">Résolution :</label>
        <input type="text" id="resolution" name="resolution" placeholder="1920x1080">
    </div>
    <div>
        <label for="format">Format :</label>
        <input type="text" id="format" name="format" placeholder="Format de la photo (ex : JPEG)">
    </div>
    <div>
        <button type="submit" name="valider" value="Envoyer">Soumettre</button>
    </div>
</form>
</body>
</html>