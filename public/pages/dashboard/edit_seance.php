<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id_seance = $_GET['id'];

    // Récupérer les informations de la séance
    $sql = "SELECT * FROM Seance WHERE id_seance = '$id_seance'";
    $result = mysqli_query($conn, $sql);
    $seance = mysqli_fetch_assoc($result);

    // Vérifier si la séance existe
    if (!$seance) {
        echo "<script>alert('Séance non trouvée.'); window.location.href = 'seances.php';</script>";
        exit();
    }

    // Traitement de la mise à jour de la séance
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date_seance = $_POST['date_seance'];
        $heure = $_POST['heure'];
        $lieu = $_POST['lieu'];

        // Requête SQL pour mettre à jour la séance
        $update_sql = "UPDATE Seance SET date_seance = '$date_seance', heure = '$heure', lieu = '$lieu' WHERE id_seance = '$id_seance'";
        if (mysqli_query($conn, $update_sql)) {
            echo "<script>alert('Séance mise à jour avec succès.'); window.location.href = 'seances.php';</script>";
        } else {
            echo "<script>alert('Erreur lors de la mise à jour de la séance.');</script>";
        }
    }
} else {
    // Si aucun ID n'est passé, redirection vers la page des séances
    header("Location: seances.php");
    exit();
}

mysqli_close($conn);
?>

<?php
include "../../composants/header.php";
include "../../composants/sidebar.php";
include "../../composants/navbar.php";
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

?>