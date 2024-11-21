<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';

//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);

//On vérifie la connexion
if(!$conn){
    die('Erreur : ' .mysqli_connect_error());
}
echo 'Connexion réussie';

$query = "INSERT INTO Client (nom, email, telephone, adresse) VALUES 
('Alice Durand', 'alice.durand@example.com', '0601010101', '12 rue des Fleurs, Nantes'),
('Bruno Martin', 'bruno.martin@example.com', '0602020202', '34 avenue des Champs, Bordeaux'),
('Claire Bernard', 'claire.bernard@example.com', '0603030303', '56 boulevard Haussmann, Paris'),
('David Lambert', 'david.lambert@example.com', '0604040404', '78 allée des Pins, Marseille'),
('Emma Lefevre', NULL, '0605050505', '90 rue du Soleil, Toulouse'),
('Frédéric Simon', 'frederic.simon@example.com', '0606060606', '123 chemin des Écoliers, Lyon'),
('Gabrielle Moreau', NULL, NULL, '5 impasse des Jardins, Lille'),
('Hugo Dubois', 'hugo.dubois@example.com', '0607070707', '7 rue de la Liberté, Grenoble'),
('Inès Laurent', 'ines.laurent@example.com', '0608080808', '9 avenue de la République, Nice'),
('Julien Petit', 'julien.petit@example.com', NULL, '11 square des Roses, Strasbourg'),
('Karine Olivier', 'karine.olivier@example.com', '0610101010', '13 quai des Vosges, Metz'),
('Louis Robert', NULL, '0611111111', '15 rue des Alpes, Annecy'),
('Manon Michel', 'manon.michel@example.com', '0612121212', '17 rue de l\'Océan, Brest'),
('Nicolas Rolland', 'nicolas.rolland@example.com', '0613131313', '19 boulevard du Midi, Tours'),
('Océane Perrot', NULL, '0614141414', '21 avenue des Étoiles, Reims'),
('Paul Fontaine', 'paul.fontaine@example.com', '0615151515', '23 impasse des Sources, Clermont-Ferrand'),
('Quentin Chevalier', 'quentin.chevalier@example.com', NULL, '25 rue des Horizons, Rouen'),
('Sophie Gauthier', 'sophie.gauthier@example.com', '0616161616', '27 chemin des Collines, Amiens'),
('Thomas Lefebvre', NULL, '0617171717', '29 rue de la Montagne, Dijon'),
('Valérie Rousseau', 'valerie.rousseau@example.com', '0618181818', '31 avenue des Vignes, Perpignan');
";

/*
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}
*/
// Requête SELECT
$query = "SELECT * FROM Client";
$result = mysqli_query($conn,$query);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "nom: ".$row['nom']. "----email: ".  $row['email']. "<br>";
    }

}


if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}

// Requête de modification (UPDATE)
$query = "UPDATE Client SET email = 'nouveau.email@example.com', telephone = '0620202020' WHERE id_client = 5";

if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}

// Requête de suppression (DELETE)
$query= "DELETE FROM Client WHERE id_client = 5";
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}


mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Cours PHP / MySQL</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Bases de données MySQL</h1>
</body>
</html>
