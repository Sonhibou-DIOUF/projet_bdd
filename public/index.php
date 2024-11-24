<?php
include "connexion_bdd.php";
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

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PicturMe</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<!-- Reservations Section -->
<section id="reservations" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Réservez votre séance</h2>
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="clientName" class="form-label">Nom du Client</label>
                    <input type="text" class="form-control" id="clientName" placeholder="Entrez votre nom">
                </div>
                <div class="col-md-6">
                    <label for="photographer" class="form-label">Choisir un Photographe</label>
                    <select id="photographer" class="form-select">
                        <option value="1">Photographe 1</option>
                        <option value="2">Photographe 2</option>
                        <option value="3">Photographe 3</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date de Séance</label>
                <input type="date" class="form-control" id="date">
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" rows="3" placeholder="Ajoutez des instructions ou remarques"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
    </div>
</section>

<!-- Sessions Section -->
<section id="sessions" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Séances Récentes</h2>
        <div class="row">
            <!-- Example Session Card -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Session Image">
                    <div class="card-body">
                        <h5 class="card-title">Séance de Mariage</h5>
                        <p class="card-text">Avec John Doe, le 10 Novembre 2024</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Voir plus</a>
                    </div>
                </div>
            </div>
            <!-- Duplicate for more sessions -->
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="contact" class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2024 PicturMe. Tous droits réservés.</p>
        <p>Email: contact@picturme.com | Téléphone: +33 1 23 45 67 89</p>
        <div>
            <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
        </div>
    </div>
</footer>

<!-- Bootstrap Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>