<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PicturMe - Agence Photo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PicturMe</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reservations">Réservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sessions">Séances</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Bienvenue chez PicturMe</h1>
        <p class="lead">L'agence photo où les souvenirs prennent vie.</p>
        <a href="#reservations" class="btn btn-primary btn-lg">Réservez votre séance</a>
    </div>
</header>

<!-- Reservations Section -->
<section id="reservations" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Réservez votre séance</h2>
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="clientName" class="form-label">Nom du Client</label>
                    <input type="text" class="form-control" id="clientName" placeholder="Entrez votre nom">
                </div>
                <div class="col-md-6">
                    <label for="photographer" class="form-label">Choisir un Photographe</label>
                    <select id="photographer" class="form-select">
                        <option value="1">Photographe 1</option>
                        <option value="2">Photographe 2</option>
                        <option value="3">Photographe 3</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date de Séance</label>
                <input type="date" class="form-control" id="date">
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" rows="3" placeholder="Ajoutez des instructions ou remarques"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
    </div>
</section>

<!-- Sessions Section -->
<section id="sessions" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Séances Récentes</h2>
        <div class="row">
            <!-- Example Session Card -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Session Image">
                    <div class="card-body">
                        <h5 class="card-title">Séance de Mariage</h5>
                        <p class="card-text">Avec John Doe, le 10 Novembre 2024</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Voir plus</a>
                    </div>
                </div>
            </div>
            <!-- Duplicate for more sessions -->
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="contact" class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2024 PicturMe. Tous droits réservés.</p>
        <p>Email: contact@picturme.com | Téléphone: +33 1 23 45 67 89</p>
        <div>
            <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
        </div>
    </div>
</footer>

<!-- Bootstrap Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
