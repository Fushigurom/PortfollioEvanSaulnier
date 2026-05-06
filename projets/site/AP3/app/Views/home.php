<?php
// session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dernière Vidéo de Hyrst - Abonnement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="home">Hyrst</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if(session()->get('LoginId')): ?>
                <li class="nav-item"><a class="nav-link active" href="home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="calendrier">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="tarifs">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact">Contact</a></li>
                    <?php if(session()->get('Role') === 1): ?>
                    <li class="nav-item"><a class="nav-link" href="Adherents">Liste Adhérents</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link active" href="home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="calendrier">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="tarifs">Tarifs</a></li>
                <?php endif; ?>
            </ul>
            <?php if(session()->get('LoginId')): ?>
                <a href="Profil" class="btn btn-outline-light me-2">Profil</a>
            <?php else: ?>
            <div class="d-flex">
                <a href="ConnexionInscription" class="btn btn-outline-light me-2">Connexion/Inscription</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mt-5 text-center">Bienvenue sur Hyrst</h1>
    <img src="assets/images/channels4_banner.jpg" style="width: 100%;" alt="">


    <!-- Contenu de la vidéo qui sera affiché après l'abonnement) -->
    <div id="video-container" style="display:none;">
        <p>Chargement de la dernière vidéo...</p>
    </div>

    <!-- Accueil de la chaîne -->
    <h2 class="mt-5 text-center">Accueil de la chaîne</h2>
    <br>
    <!-- Carte Google Maps -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5756.234739854709!2d4.366512076097017!3d43.83266427109419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b42d103fb896a9%3A0x2d491738deb25561!2sLyc%C3%A9e%20CCI%20Gard!5e0!3m2!1sfr!2sfr!4v1732620577613!5m2!1sfr!2sfr" width="1300" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe><br><br>
</div>
<!-- Script JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="javascript/script.js"></script>
</body>
</html>
