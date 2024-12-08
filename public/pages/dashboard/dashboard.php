<?php
include "../../login/connexion_bdd.php";
include "../../composants/header.php";
include "../../composants/navbar.php";
include "../../composants/sidebar.php";
include "../../composants/alert.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe =$_POST['mot_de_passe'];
    $sql = "INSERT INTO Utilisateurs (email, mot_de_passe,role) VALUES ('$email','$mot_de_passe','admin')";
    if(mysqli_query($conn, $sql)){
        $_SESSION['success'] = 'Admin ajouté avec succes';
    }else{
        $_SESSION['error'] = 'erreur ajout admin';
    }
}
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Bienvenue dans votre Tableau de Bord Admin</h1>
    <p>Sélectionner un onglet à gauche pour commencer</p>
    <!-- Formulaire d'ajout d'admin -->
    <div class="card mb-4">
        <div class="card-header">Ajouter un nouveau admin</div>
        <div class="card-body">
            <form action="dashboard.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email de l'admin" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>

</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
