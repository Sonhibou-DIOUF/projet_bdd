<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
include "../../composants/alert.php"; // Inclusion des alertes

// Vérifier si la session est démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_client'])) {
    die("Erreur : Vous devez vous connecter pour accéder à cette page.");
}

$id_client = $_SESSION['id_client'];

// Récupérer les informations de l'utilisateur
$sql_utilisateur = "SELECT id_utilisateur, email FROM Utilisateurs WHERE id_utilisateur = ?";
$stmt_utilisateur = mysqli_prepare($conn, $sql_utilisateur);

if ($stmt_utilisateur) {
    mysqli_stmt_bind_param($stmt_utilisateur, "i", $id_client);
    mysqli_stmt_execute($stmt_utilisateur);
    $result_utilisateurs = mysqli_stmt_get_result($stmt_utilisateur);
    if (mysqli_num_rows($result_utilisateurs) > 0) {
        $utilisateurs = mysqli_fetch_assoc($result_utilisateurs);
    } else {
        die("Erreur : Utilisateur introuvable.");
    }
    mysqli_stmt_close($stmt_utilisateur);
} else {
    die("Erreur lors de la récupération des informations utilisateur.");
}

// Vérifier si l'email existe dans la table Client
$sql_client = "SELECT * FROM Client WHERE email = ?";
$stmt_client = mysqli_prepare($conn, $sql_client);

if ($stmt_client) {
    mysqli_stmt_bind_param($stmt_client, "s", $utilisateurs['email']);
    mysqli_stmt_execute($stmt_client);
    $result_client = mysqli_stmt_get_result($stmt_client);
    if (mysqli_num_rows($result_client) > 0) {
        $client = mysqli_fetch_assoc($result_client);
    } else {
        die("Erreur : Client introuvable.");
    }
    mysqli_stmt_close($stmt_client);
} else {
    die("Erreur lors de la récupération des informations client.");
}

// Récupérer les séances du client
$sql_seances = "SELECT * FROM Seance 
                JOIN Client ON Seance.id_client = Client.id_client 
                JOIN Photographe ON Seance.id_photographe = Photographe.id_photographe 
                WHERE Client.id_client = ? 
                ORDER BY date_seance DESC";
$stmt_seances = mysqli_prepare($conn, $sql_seances);

if ($stmt_seances) {
    mysqli_stmt_bind_param($stmt_seances, "i", $client['id_client']);
    mysqli_stmt_execute($stmt_seances);
    $result_seances = mysqli_stmt_get_result($stmt_seances);
} else {
    die("Erreur lors de la récupération des séances.");
}

// Récupérer les photos du client
$sql_photos = "SELECT * FROM Seance 
               JOIN Photo ON Seance.id_seance = Photo.id_seance 
               WHERE Seance.id_client = ? 
               ORDER BY date_seance DESC";
$stmt_photos = mysqli_prepare($conn, $sql_photos);

if ($stmt_photos) {
    mysqli_stmt_bind_param($stmt_photos, "i", $client['id_client']);
    mysqli_stmt_execute($stmt_photos);
    $result_photos = mysqli_stmt_get_result($stmt_photos);
} else {
    die("Erreur lors de la récupération des photos.");
}
?>

<!-- Main Content -->
<div class="container">
    <h1 class="mb-4">Tableau de Bord Client</h1>

    <!-- Section Informations personnelles -->
    <div class="card mb-4">
        <div class="card-header">Informations du Client</div>
        <div class="card-body">
            <p><strong>Nom :</strong> <?php echo isset($client['nom']) ? htmlspecialchars($client['nom']) : "Non renseigné"; ?></p>
            <p><strong>Email :</strong> <?php echo isset($client['email']) ? htmlspecialchars($client['email']) : "Non renseigné"; ?></p>
            <p><strong>Téléphone :</strong> <?php echo isset($client['telephone']) ? htmlspecialchars($client['telephone']) : "Non renseigné"; ?></p>
            <p><strong>Adresse :</strong> <?php echo isset($client['adresse']) ? htmlspecialchars($client['adresse']) : "Non renseigné"; ?></p>
            <div class="text-center">
                <?php if (isset($client['id_client'])): ?>
                    <a href="edit_client_by_client.php?id=<?php echo htmlspecialchars($client['id_client']); ?>" class="btn btn-warning">Modifier Profil</a>
                <?php else: ?>
                    <p class="text-danger">Impossible de modifier le profil : ID client introuvable.</p>
                <?php endif; ?>
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
                    <th>Photographe</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result_seances) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result_seances)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['date_seance']); ?></td>
                            <td><?php echo htmlspecialchars($row['lieu']); ?></td>
                            <td><?php echo htmlspecialchars($row['heure']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
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

<?php
// Fermer les requêtes préparées restantes
if ($stmt_seances) mysqli_stmt_close($stmt_seances);
if ($stmt_photos) mysqli_stmt_close($stmt_photos);

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
