<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données
session_start();

// Vérifier si l'utilisateur est connecté en tant que photographe
if (!isset($_SESSION['id_photographe'])) {
    header("Location: ../../login/loginPage.php"); // Rediriger si l'utilisateur n'est pas connecté
    exit();
}

$id_photographe = $_SESSION['id_photographe'];

// Récupérer les informations du photographe depuis la base de données
$sql_utilisateur="select email from Utilisateurs where id_utilisateur=$id_photographe";
$result_utilisateurs = mysqli_query($conn, $sql_utilisateur);
$utilisateurs =mysqli_fetch_assoc($result_utilisateurs);
$sql_photographe = "SELECT * FROM Photographe WHERE email = '$utilisateurs[email]'";
$result_photographe = mysqli_query($conn, $sql_photographe);
$photographe = mysqli_fetch_assoc($result_photographe);

// Récupérer les séances associées au photographe
$sql_seances = "SELECT * FROM Seance WHERE id_photographe = '$id_photographe' ORDER BY date_seance DESC";
$result_seances = mysqli_query($conn, $sql_seances);

// Récupérer les photos prises par le photographe
$sql_photos = "SELECT * FROM Photo WHERE id_photographe = '$id_photographe'";
//$result_photos = mysqli_query($conn, $sql_photos);
?>

<?php
include "../../composants/header.php";
include "../../composants/navbar.php";
?>

<!-- Main Content -->
<div class="container">
    <h1 class="mb-4">Tableau de Bord Photographe</h1>

    <!-- Section Informations personnelles -->
    <div class="card mb-4">
        <div class="card-header">Informations du Photographe</div>
        <div class="card-body">
            <p><strong>Nom :</strong> <?php echo $photographe['nom']; ?></p>
            <p><strong>Spécialité :</strong> <?php echo $photographe['specialite']; ?></p>
            <p><strong>Email :</strong> <?php echo $photographe['email']; ?></p>
            <p><strong>Téléphone :</strong> <?php echo $photographe['telephone']; ?></p>
            <div class="text-center">
                <a href="edit_photographe.php?id=<?php echo $photographe['id_photographe']; ?>" class="btn btn-warning">Modifier Profil</a>
                <a href="delete_photographe.php?id=<?php echo $photographe['id_photographe']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">Supprimer Compte</a>
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
                    <th>#</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Client</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result_seances) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result_seances)): ?>
                        <tr>
                            <td><?php echo $row['id_seance']; ?></td>
                            <td><?php echo $row['date_seance']; ?></td>
                            <td><?php echo $row['lieu']; ?></td>
                            <td><?php echo $row['id_client']; ?></td> <!-- Remplacez ceci par le nom du client si nécessaire -->
                            <td><?php echo ($row['id_client'] == 1) ? "Confirmée" : "Non confirmée"; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucune séance trouvée</td>
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

