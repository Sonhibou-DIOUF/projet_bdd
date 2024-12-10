<?php
// Inclusion du fichier pour la connexion à la base de données
include "../../login/connexion_bdd.php";

// Vérification de la méthode de la requête HTTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Insertion des données dans la table Client avec une requête préparée
    $sql = "INSERT INTO Client (nom, email, telephone, adresse) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Lier les paramètres
        mysqli_stmt_bind_param($stmt, "ssss", $nom, $email, $telephone, $adresse);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            // Message de succès en cas d'insertion réussie
            $_SESSION['success'] = 'Client ajouté avec succès';
        } else {
            // Message d'erreur en cas d'échec de l'insertion
            $_SESSION['error'] = 'Erreur lors de l\'ajout du client';
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        // Gestion de l'erreur si la préparation échoue
        $_SESSION['error'] = 'Une erreur s\'est produite lors de la préparation de la requête';
    }

    // Insertion des données dans la table utilisateurs avec une requête préparée
    $sql_user = "INSERT INTO utilisateurs (email, mot_de_passe, role) VALUES (?, ?, 'client')";
    $stmt_user = mysqli_prepare($conn, $sql_user);
    if ($stmt_user) {
        // Lier les paramètres
        mysqli_stmt_bind_param($stmt_user, "ss", $email, $mot_de_passe);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt_user)) {
            // Message de succès pour l'ajout d'utilisateur
            $_SESSION['success'] = 'Utilisateur ajouté avec succès';
        } else {
            // Message d'erreur en cas d'échec de l'insertion de l'utilisateur
            $_SESSION['error'] = 'Erreur lors de l\'ajout de l\'utilisateur';
        }

        // Fermer la requête préparée pour l'utilisateur
        mysqli_stmt_close($stmt_user);
    } else {
        // Gestion de l'erreur si la préparation échoue
        $_SESSION['error'] = 'Une erreur s\'est produite lors de la préparation de la requête pour l\'utilisateur';
    }
}

// Récupérer la liste des clients avec une requête sécurisée
$sql = "SELECT * FROM Client";
$result = $conn->query($sql);
?>

<?php
// Inclusion des composants de l'en-tête, de la barre de navigation et de la barre latérale
include "../../composants/header.php";
include "../../composants/navbar.php";
include "../../composants/sidebar.php";
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Gestion des Clients</h1>
    <!-- Formulaire d'ajout de client -->
    <div class="card mb-4">
        <div class="card-header">Ajouter un nouveau client</div>
        <div class="card-body">
            <form action="clients.php" method="post">
                <div class="mb-3">
                    <label for="Nom" class="form-label">Nom</label>
                    <input type="text" id="Nom" name="nom" class="form-control" placeholder="Nom du client" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email du client" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Téléphone du client" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Adresse du client" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>

    <!-- Liste des clients -->
    <div class="card">
        <div class="card-header">Liste des clients</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_client']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['adresse']; ?></td>
                            <td>
                                <a href="edit_client.php?id=<?php echo $row['id_client']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="delete_client.php?id=<?php echo $row['id_client']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucun client trouvé</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>
<?php
// Ferme la connexion à la base de données
$conn->close();
?>
