<?php
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">'
    . $_SESSION["message"] .
  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_SESSION['error'])) {
    echo
    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    . $_SESSION["error"] .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    . $_SESSION["success"] .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

