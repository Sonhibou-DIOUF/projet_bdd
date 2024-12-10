<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_seance = $_GET['id'];

    // Sécuriser l'ID de la séance (validation numérique)
    if (!is_numeric($id_seance)) {
        echo "<script>alert('ID de séance invalide.'); window.location.href = 'seances.php';</script>";
        exit();
    }

    // Récupérer les informations de la séance avec une requête préparée
    $sql = "SELECT * FROM Seance WHERE id_seance = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Lier l'ID de la séance au paramètre de la requête
        mysqli_stmt_bind_param($stmt, "i", $id_seance);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $seance = mysqli_fetch_assoc($result);

        // Vérifier si la séance existe
        if (!$seance) {
            echo "<script>alert('Séance non trouvée.'); window.location.href = 'seances.php';</script>";
            exit();
        }
        mysqli_stmt_close($stmt); // Fermer la requête préparée
    }

    // Traitement de la mise à jour de la séance
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer et valider les données du formulaire
        $date_seance = $_POST['date_seance'];
        $heure = $_POST['heure'];
        $lieu = $_POST['lieu'];

        // Validation simple pour la date et l'heure
        if (empty($date_seance) || empty($heure) || empty($lieu)) {
            echo "<script>alert('Tous les champs sont obligatoires.');</script>";
            exit();
        }

        // Requête SQL pour mettre à jour la séance avec des requêtes préparées
        $update_sql = "UPDATE Seance SET date_seance = ?, heure = ?, lieu = ? WHERE id_seance = ?";
        $stmt_update = mysqli_prepare($conn, $update_sql);

        if ($stmt_update) {
            // Lier les paramètres à la requête préparée
            mysqli_stmt_bind_param($stmt_update, "sssi", $date_seance, $heure, $lieu, $id_seance);

            // Exécuter la mise à jour
            if (mysqli_stmt_execute($stmt_update)) {
                // Alerte de succès et redirection
                echo "<script>alert('Séance mise à jour avec succès.'); window.location.href = 'seances.php';</script>";
            } else {
                // Alerte d'erreur
                echo "<script>alert('Erreur lors de la mise à jour de la séance.');</script>";
            }

            mysqli_stmt_close($stmt_update); // Fermer la requête préparée
        } else {
            echo "<script>alert('Erreur lors de la mise à jour de la séance.');</script>";
        }
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des séances
    header("Location: seances.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>


<?php
include "../../composants/header.php"; // Inclusion de l'en-tête
include "../../composants/sidebar.php"; // Inclusion de la barre latérale
include "../../composants/navbar.php"; // Inclusion de la barre de navigation
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Modifier la Séance</h1>

    <!-- Formulaire de modification de séance -->
    <div class="card mb-4">
        <div class="card-header">Modifier les détails de la séance</div>
        <div class="card-body">
            <form action="edit_seance.php?id=<?php echo $id_seance; ?>" method="post">
                <div class="mb-3">
                    <label for="date_seance" class="form-label">Date de la séance</label>
                    <input type="date" id="date_seance" name="date_seance" class="form-control" value="<?php echo $seance['date_seance']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="heure" class="form-label">Heure de la séance</label>
                    <input type="time" id="heure" name="heure" class="form-control" value="<?php echo $seance['heure']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu de la séance</label>
                    <input type="text" id="lieu" name="lieu" class="form-control" value="<?php echo $seance['lieu']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
