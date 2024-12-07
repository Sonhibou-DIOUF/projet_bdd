
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PicturMe - Votre Agence de Photographie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">PicturMe</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#about">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
            <div class="d-flex">
                <a href="login/loginPage.php" class="btn btn-outline-light">Login</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="text-center bg-light py-5">
    <div class="container">
        <h1 class="display-4">Bienvenue chez PicturMe</h1>
        <p class="lead">Votre agence de photographie dédiée à capturer vos moments précieux avec excellence.</p>
        <a href="#services" class="btn btn-primary btn-lg">Découvrez nos services</a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="../ressources/images/photography-256868_1280.jpg" alt="Photo concept" class="img-fluid rounded">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h2>À propos de nous</h2>
                <p>
                    PicturMe est une agence de photographie innovante, combinant passion artistique et technologie
                    avancée pour offrir des services de qualité. Notre mission est de rendre vos souvenirs inoubliables.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Nos Services</h2>
            <p class="text-muted">Découvrez ce que nous offrons</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Clients</h5>
                        <p class="card-text">Photographes et entreprises, gérez facilement vos profils.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Événements & Séances</h5>
                        <p class="card-text">Planifiez et réservez vos séances photo en toute simplicité.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Photos</h5>
                        <p class="card-text">Stockez, recherchez et visualisez vos photos en toute sécurité.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Paiements & Factures</h5>
                        <p class="card-text">Gérez vos paiements et factures facilement et en toute transparence.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Contactez-nous</h2>
            <p class="text-muted">Nous serons ravis de répondre à vos besoins.</p>
        </div>
        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" placeholder="Nom">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="mb-3">
                <textarea class="form-control" rows="5" placeholder="Votre message"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
</section>
<?php
include "composants/footer.php";
?>
