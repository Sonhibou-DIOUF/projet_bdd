<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_client'])) {
    header("Location: ../../login/loginPage.php"); // Rediriger si l'utilisateur n'est pas connecté
    exit();
}

$id_client = $_SESSION['id_client'];

// Récupérer les informations du client depuis la base de données
$sql_utilisateur = "select email from Utilisateurs where id_utilisateur=$id_client"; // coorection sur la bdd
$result_utilisateurs = mysqli_query($conn, $sql_utilisateur);
$utilisateurs = mysqli_fetch_assoc($result_utilisateurs);
$sql_client = "SELECT * FROM Client WHERE email = '$utilisateurs[email]'";
$result_client = mysqli_query($conn, $sql_client);
$client = mysqli_fetch_assoc($result_client);

// Récupérer les séances du client

$sql_seances = "SELECT * FROM Seance WHERE id_client = '$id_client' ORDER BY date_seance DESC";
$result_seances = mysqli_query($conn, $sql_seances);

// Récupérer les photos du client
$sql_photos = "SELECT * FROM Photo WHERE id_photo = '$id_client'";
$result_photos = mysqli_query($conn, $sql_photos);
?>

<?php
include "../../composants/header.php";
include "../../composants/navbar.php";
?>

<!-- Main Content -->
<div class="container">
    <h1 class="mb-4">Tableau de Bord Client</h1>

    <!-- Section Informations personnelles -->
    <div class="card mb-4">
        <div class="card-header">Informations du Client</div>
        <div class="card-body">
            <p><strong>Nom :</strong> <?php echo $client['nom']; ?></p>
            <p><strong>Email :</strong> <?php echo $client['email']; ?></p>
            <p><strong>Téléphone :</strong> <?php echo $client['telephone']; ?></p>
            <p><strong>Adresse :</strong> <?php echo $client['adresse']; ?></p>
            <div class="text-center">
                <a href="edit_client_by_client.php?id=<?php echo $client['id_client']; ?>" class="btn btn-warning">Modifier Profil</a>
            </div>
        </div>
    </div>

    <!-- Section Séances -->
    <div class="card mb-4">
        <div class="card-header">Séances de Photographie</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Heure</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result_seances) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result_seances)): ?>
                        <tr>

                            <td><?php echo $row['date_seance']; ?></td>
                            <td><?php echo $row['lieu']; ?></td>
                            <td><?php echo $row['heure']; ?></td>

                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucune séance trouvée</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section Photos -->
    <div class="card mb-4">
        <div class="card-header">Vos Photos</div>
        <div class="card-body">
            <div class="row">
                <?php if (mysqli_num_rows($result_photos) > 0): ?>
                    <?php while ($photo = mysqli_fetch_assoc($result_photos)): ?>
                        <div class="col-md-4 mb-3">
                            <img src="../../uploads/<?php echo $photo['file_name']; ?>" alt="Photo" class="img-fluid">
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Aucune photo disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

</body>
</html>

<?php
mysqli_close($conn);
?>

