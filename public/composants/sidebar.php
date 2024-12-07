<?php
$current_page = basename($_SERVER['PHP_SELF']); // Pour savoir la page courante ( items selectionne par l'utilsateur)
?>

<div class="sidebar d-flex flex-column">
    <div class="nav-links flex-grow-1">
        <a href="dashboard.php" class="d-flex align-items-center <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>">
            <i class="fas fa-user me-3"></i> Administrateurs
        </a>
        <a href="clients.php" class="d-flex align-items-center <?php echo $current_page == 'clients.php' ? 'active' : ''; ?>">
            <i class="fas fa-user me-3"></i> Clients
        </a>
        <a href="seances.php" class="d-flex align-items-center <?php echo $current_page == 'seances.php' ? 'active' : ''; ?>">
            <i class="fas fa-calendar-alt me-3"></i> Séances
        </a>
        <a href="photos.php" class="d-flex align-items-center <?php echo $current_page == 'photos.php' ? 'active' : ''; ?>">
            <i class="fas fa-camera me-3"></i> Photos
        </a>
        <a href="photographes.php" class="d-flex align-items-center <?php echo $current_page == 'photographes.php' ? 'active' : ''; ?>">
            <i class="fas fa-users me-3"></i> Photographes
        </a>
        <a href="transactions.php" class="d-flex align-items-center <?php echo $current_page == 'transactions.php' ? 'active' : ''; ?>">
            <i class="fas fa-credit-card me-3"></i> Transactions
        </a>
    </div>
    <div class="logout-section">
        <!-- Ajoutez ici un bouton de déconnexion ou toute autre information -->
    </div>
</div>
