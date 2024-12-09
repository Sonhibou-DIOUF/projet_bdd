<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container-fluid">
        <!-- Icône de caméra avec un espace à droite -->
        <i class="fa fa-camera-retro me-2" aria-hidden="true"></i>
        <!-- Nom de la marque PicturMe -->
        <span class="navbar-brand">PicturMe</span>
        <div class="collapse navbar-collapse justify-content-end">
            <?php
            // Vérifie si l'utilisateur est connecté
            if(isset($_SESSION['email'] )){
                // Si l'utilisateur est connecté, afficher le bouton de déconnexion
                echo '<a href="../../login/logout.php" class="btn btn-danger d-flex align-items-center ">
                <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                </a>';
            }
            ?>
        </div>
    </div>
</nav>
