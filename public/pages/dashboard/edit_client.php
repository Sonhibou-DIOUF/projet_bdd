<?php
include "../../login/connexion_bdd.php"; // Connexion à la base de données

// Vérifiez si l'ID du client est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Récupérez les informations du client
    $sql = "SELECT * FROM Client WHERE id_client = '$id_client'";
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_assoc($result);

    if (!$client) {
        echo "<script>alert('Client introuvable.'); window.location.href = 'clients.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Aucun client spécifié.'); window.location.href = 'clients.php';</script>";
    exit();
}

// Gestion de la soumission du formulaire pour la modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    // Mise à jour des informations du client dans la table Client
    $sql_update_client = "UPDATE Client 
                          SET nom = '$nom', email = '$email', telephone = '$telephone', adresse = '$adresse' 
                          WHERE id_client = '$id_client'";

    // Récupérer l'ID de l'utilisateur lié au client en fonction de l'email
    $sql_get_id_utilisateur = "SELECT id_utilisateur FROM Utilisateurs WHERE email = '$client[email]'";
    $result_utilisateur = mysqli_query($conn, $sql_get_id_utilisateur);
    $utilisateur = mysqli_fetch_assoc($result_utilisateur);

    // Si l'utilisateur existe, mettez à jour l'email de l'utilisateur
    if ($utilisateur) {
        $id_utilisateur = $utilisateur['id_utilisateur'];

        // Mise à jour de l'email dans la table Utilisateur
        $sql_update_utilisateur = "UPDATE Utilisateurs 
                                   SET email = '$email' 
                                   WHERE id_utilisateur = '$id_utilisateur'";

        // Exécution de la mise à jour dans la base de données
        if (mysqli_query($conn, $sql_update_client) && mysqli_query($conn, $sql_update_utilisateur)) {
            echo "<script>alert('Client mis à jour avec succès.'); window.location.href = 'clients.php';</script>";
        } else {
            echo "<script>alert('Erreur lors de la mise à jour du client.'); window.location.href = 'edit_client.php?id=$id_client';</script>";
        }
    } else {
        echo "<script>alert('Utilisateur correspondant à l\'email du client introuvable.'); window.location.href = 'edit_client.php?id=$id_client';</script>";
    }
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
    <h1 class="mb-4">Modifier un Client</h1>
    <div class="card">
        <div class="card-header">Modifier les informations du client</div>
        <div class="card-body">
            <form action="edit_client.php?id=<?php echo $id_client; ?>" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $client['nom']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $client['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control" value="<?php echo $client['telephone']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" id="adresse" name="adresse" class="form-control" value="<?php echo $client['adresse']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="clients.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
