<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté en tant que photographe
if (!isset($_SESSION['id_photographe'])) {
    header("Location: ../../login/loginPage.php"); // Rediriger si l'utilisateur n'est pas connecté
    exit();
}

$id_photographe = $_SESSION['id_photographe'];

// Récupérer les informations de l'utilisateur
$sql_utilisateur = "SELECT email FROM Utilisateurs WHERE id_utilisateur = ?";
$stmt_utilisateur = mysqli_prepare($conn, $sql_utilisateur);

if ($stmt_utilisateur) {
    mysqli_stmt_bind_param($stmt_utilisateur, "i", $id_photographe);
    mysqli_stmt_execute($stmt_utilisateur);
    $result_utilisateurs = mysqli_stmt_get_result($stmt_utilisateur);
    $utilisateurs = mysqli_fetch_assoc($result_utilisateurs);
    mysqli_stmt_close($stmt_utilisateur);
} else {
    die("Erreur lors de la récupération des informations utilisateur.");
}

// Récupérer les informations du photographe
$sql_photographe = "SELECT * FROM Photographe WHERE email = ?";
$stmt_photographe = mysqli_prepare($conn, $sql_photographe);

if ($stmt_photographe) {
    mysqli_stmt_bind_param($stmt_photographe, "s", $utilisateurs['email']);
    mysqli_stmt_execute($stmt_photographe);
    $result_photographe = mysqli_stmt_get_result($stmt_photographe);
    $photographe = mysqli_fetch_assoc($result_photographe);
    mysqli_stmt_close($stmt_photographe);
} else {
    die("Erreur lors de la récupération des informations du photographe.");
}

// Récupérer les séances associées au photographe
$sql_seances = "SELECT * FROM Photographe 
                JOIN Seance ON Seance.id_photographe = Photographe.id_photographe 
                JOIN Client ON Seance.id_client = Client.id_client 
                WHERE Photographe.id_photographe = ? 
                ORDER BY date_seance DESC";
$stmt_seances = mysqli_prepare($conn, $sql_seances);

if ($stmt_seances) {
    mysqli_stmt_bind_param($stmt_seances, "i", $photographe['id_photographe']);
    mysqli_stmt_execute($stmt_seances);
    $result_seances = mysqli_stmt_get_result($stmt_seances);
} else {
    die("Erreur lors de la récupération des séances.");
}

// Récupérer les photos prises par le photographe
$sql_photos = "SELECT * FROM Seance 
               JOIN Photo ON Seance.id_seance = Photo.id_seance 
               WHERE Seance.id_photographe = ? 
               ORDER BY date_seance DESC";
$stmt_photos = mysqli_prepare($conn, $sql_photos);

if ($stmt_photos) {
    mysqli_stmt_bind_param($stmt_photos, "i", $photographe['id_photographe']);
    mysqli_stmt_execute($stmt_photos);
    $result_photos = mysqli_stmt_get_result($stmt_photos);
} else {
    die("Erreur lors de la récupération des photos.");
}
?>

<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
include "../../composants/alert.php"; // Inclusion des alertes
?>

<!-- Main Content -->
<div class="container">
    <h1 class="mb-4">Tableau de Bord Photographe</h1>

    <!-- Section Informations personnelles -->
    <div class="card mb-4">
        <div class="card-header">Informations du Photographe</div>
        <div class="card-body">
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($photographe['nom']); ?></p>
            <p><strong>Spécialité :</strong> <?php echo htmlspecialchars($photographe['specialite']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($photographe['email']); ?></p>
            <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($photographe['telephone']); ?></p>
            <div class="text-center">
                <a href="edit_photographe_by_photographe.php?id=<?php echo $photographe['id_photographe']; ?>" class="btn btn-warning">Modifier Profil</a>
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
                    <th>Heure</th>
                    <th>Lieu</th>
                    <th>Client</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result_seances) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result_seances)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_seance']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_seance']); ?></td>
                            <td><?php echo htmlspecialchars($row['heure']); ?></td>
                            <td><?php echo htmlspecialchars($row['lieu']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
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
                            <img src="../../uploads/<?php echo htmlspecialchars($photo['chemin_fichier']); ?>" alt="Photo" class="img-fluid">
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
// Libérer les résultats des requêtes
if ($stmt_seances) mysqli_stmt_close($stmt_seances);
if ($stmt_photos) mysqli_stmt_close($stmt_photos);

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
