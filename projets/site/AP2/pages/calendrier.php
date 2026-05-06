<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Vidéos - Hyrst</title>
    <!-- Lien vers Bootstrap 5 pour la mise en forme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css"> <!-- Lien vers votre CSS personnalisé -->
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Hyrst</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link active" href="../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="calendrier.php">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="tarifs.php">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="adherentsLister.php">Liste Adhérents</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link active" href="../index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="calendrier.php">Calendrier</a></li>
                <li class="nav-item"><a class="nav-link" href="tarifs.php">Tarifs</a></li>
                <?php endif; ?>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="navbar-text text-white me-3"><?= htmlspecialchars($_SESSION['user']['Prenom']) ?></span>
                <?php else: ?>
                    <a href="connexion.html" class="btn btn-outline-light me-2">Connexion</a>
                    <a href="inscription.html" class="btn btn-primary">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center mb-4">Calendrier des Vidéos</h1>

    <div class="alert alert-info text-center">
        <p><strong>Une nouvelle vidéo est publiée chaque jour de 8h à 18h.</strong></p>
        <p>Retrouvez chaque jour une vidéo à n'importe quelle heure dans cet intervalle !</p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Lundi</h3>
            <p>Vidéo disponible de 8h à 18h.</p>
        </div>
        <div class="col-md-6">
            <h3>Mardi</h3>
            <p>Vidéo disponible de 8h à 18h.</p>
        </div>
        <div class="col-md-6">
            <h3>Mercredi</h3>
            <p>Vidéo disponible de 8h à 18h.</p>
        </div>
        <div class="col-md-6">
            <h3>Jeudi</h3>
            <p>Vidéo disponible de 8h à 18h.</p>
        </div>
        <div class="col-md-6">
            <h3>Vendredi</h3>
            <p>Vidéo disponible de 8h à 18h.</p>
        </div>
        <div class="col-md-6">
            <h3>Samedi</h3>
            <p>Vidéo disponible de 8h à 18h.</p>
        </div>
        <div class="col-md-6">
            <h3>Dimanche</h3>
            <p>Vidéo disponible de 8h à 18h.</p>
        </div>
    </div>

</div>

<!-- Script JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../javascript/script.js"></script>

</body>
</html>
