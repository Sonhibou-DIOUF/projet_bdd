<?php
// Vérifie si une session 'message' existe et l'affiche comme une alerte bootstrap
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">'
    . $_SESSION["message"] .
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

// Vérifie si une session 'error' existe et l'affiche comme une alerte bootstrap
if (isset($_SESSION['error'])) {
    echo
    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
    . $_SESSION["error"] .
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

// Vérifie si une session 'success' existe et l'affiche comme une alerte bootstrap
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
    . $_SESSION["success"] .
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

    // Supprimer la variable de session après 1 seconde côté serveur
    unset($_SESSION['message']);
    unset($_SESSION['success']);
    unset($_SESSION['error']);

?>
