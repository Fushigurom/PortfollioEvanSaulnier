<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Hyrst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">Hyrst</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if(session()->get('Role') === 1): ?>
                    <li class="nav-item"><a class="nav-link" href="/home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/calendrier">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tarifs">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Adherents">Liste Adhérents</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/calendrier">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tarifs">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                <?php endif; ?>
            </ul>
        <div class="d-flex">
            <span class="navbar-text text-white me-3"><?= session()->get('Prenom') ?></span>
            <a href="deconnexion" class="btn btn-outline-light">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Mon Compte</h1>
    <div class="card mx-auto mt-4" style="max-width: 400px;">
        <div class="card-body">
            <h5 class="card-title text-center">Informations du compte :</h5>
            <p><strong>Nom :</strong> <?= session()->get('Nom') ?></p>
            <p><strong>Prénom :</strong> <?= session()->get('Prenom'); ?></p>
            <p><strong>Email :</strong> <?= session()->get('AdresseMail'); ?></p>
            <p><strong>Numéro de téléphone :</strong> <?= session()->get('NumeroTel'); ?></p>
        </div>  
    </div>
</div>

</body>
</html>