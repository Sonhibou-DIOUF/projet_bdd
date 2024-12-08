<?php
include "../../login/connexion_bdd.php"; // Fichier de connexion à la base de données

// Gestion de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $date_seance = $_POST['date_seance'];
    $heure = $_POST['heure'];
    $lieu = $_POST['lieu'];
    $id_photographe = $_POST['id_photographe'];
    $id_client = $_POST['id_client'];

    // Insertion dans la table Seance
    $sql = "INSERT INTO Seance (date_seance, heure, lieu, id_photographe, id_client) 
            VALUES ('$date_seance', '$heure', '$lieu', '$id_photographe', '$id_client')";

    // Vérification si l'insertion a réussi
    if (mysqli_query($conn, $sql)) {
        // Récupérer l'id_seance inséré
        $id_seance = mysqli_insert_id($conn);

        // Insertion dans la table Effectue
        $sql_effectue = "INSERT INTO Effectue (id_photographe, id_seance)
                         VALUES ('$id_photographe', '$id_seance')";
        
        // Vérification si l'insertion a réussi
        if (mysqli_query($conn, $sql_effectue)) {
            echo "<script>alert('Séance et relation ajoutées avec succès');</script>";
        } else {
            echo "<script>alert('Erreur lors de l\'ajout de la relation dans Effectue');</script>";
        }
    } else {
        echo "<script>alert('Erreur lors de l\'ajout de la séance');</script>";
    }
}

// Récupération des séances existantes
$sql = "SELECT date_seance, heure, lieu, id_seance, Client.nom AS nom, Photographe.nom AS nom_photographe
        FROM Seance 
        JOIN Client ON Seance.id_client = Client.id_client 
        JOIN Photographe ON Seance.id_photographe = Photographe.id_photographe";
$result = mysqli_query($conn, $sql);

// Vérification de l'exécution de la requête SQL
if ($result === false) {
    die('Erreur SQL : ' . mysqli_error($conn));
}

// Récupération des photographes
$sql_photographes = "SELECT id_photographe, nom FROM Photographe";
$result_photographes = mysqli_query($conn, $sql_photographes);

// Vérification de l'exécution de la requête SQL pour les photographes
if ($result_photographes === false) {
    die('Erreur SQL : ' . mysqli_error($conn));
}

// Récupération des clients
$sql_clients = "SELECT id_client, nom FROM Client";
$result_clients = mysqli_query($conn, $sql_clients);

// Vérification de l'exécution de la requête SQL pour les clients
if ($result_clients === false) {
    die('Erreur SQL : ' . mysqli_error($conn));
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
include "../../composants/sidebar.php"; // Inclusion de la barre latérale
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Gestion des Séances</h1>

    <!-- Formulaire d'ajout de séance -->
    <div class="card mb-4">
        <div class="card-header">Ajouter une nouvelle séance</div>
        <div class="card-body">
            <form action="seances.php" method="post">
                <div class="mb-3">
                    <label for="date_seance" class="form-label">Date de la séance</label>
                    <input type="date" id="date_seance" name="date_seance" class="form-control" placeholder="Date de la séance" required>
                </div>
                <div class="mb-3">
                    <label for="heure" class="form-label">Heure de la séance</label>
                    <input type="time" id="heure" name="heure" class="form-control" placeholder="Heure de la séance" required>
                </div>
                <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" id="lieu" name="lieu" class="form-control" placeholder="Lieu de la séance" required>
                </div>
                <div class="mb-3">
                    <label for="id_photographe" class="form-label">Photographe</label>
                    <select id="id_photographe" name="id_photographe" class="form-select" required>
                        <option value="" disabled selected>Choisir un photographe</option>
                        <?php while ($row = mysqli_fetch_assoc($result_photographes)): ?>
                            <option value="<?php echo $row['id_photographe']; ?>">
                                <?php echo $row['nom']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_client" class="form-label">Client</label>
                    <select id="id_client" name="id_client" class="form-select" required>
                        <option value="" disabled selected>Choisir un client</option>
                        <?php while ($row = mysqli_fetch_assoc($result_clients)): ?>
                            <option value="<?php echo $row['id_client']; ?>">
                                <?php echo $row['nom']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>

    <!-- Liste des séances -->
    <div class="card">
        <div class="card-header">Liste des séances</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Lieu</th>
                    <th>Photographe</th>
                    <th>Client</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id_seance']; ?></td>
                            <td><?php echo $row['date_seance']; ?></td>
                            <td><?php echo $row['heure']; ?></td>
                            <td><?php echo $row['lieu']; ?></td>
                            <td><?php echo $row['nom_photographe']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td>
                                <a href="edit_seance.php?id=<?php echo $row['id_seance']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="delete_seance.php?id=<?php echo $row['id_seance']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucune séance trouvée</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
