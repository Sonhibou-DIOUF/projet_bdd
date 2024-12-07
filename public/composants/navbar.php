<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container-fluid">
        <i class="fa fa-camera-retro me-2" aria-hidden="true"></i>
        <span class="navbar-brand">PicturMe</span>
        <div class="collapse navbar-collapse justify-content-end">
            <?php

            if(isset($_SESSION['email'] )){
                echo '<a href="../../login/logout.php" class="btn btn-danger d-flex align-items-center ">
                <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                </a>';
            }
            ?>

        </div>
    </div>
</nav>
<?php
include "alert.php";
?>