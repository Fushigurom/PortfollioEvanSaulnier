<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des adhérents</title>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/cssAdherents.css') ?>">

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
                <li class="nav-item"><a class="nav-link" href="home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="calendrier">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="tarifs">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active" href="Adherents">Liste Adhérents</a></li>
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

    <div class="container my-5">
        <h1 class="text-center">Liste des adhérents</h1>
        <div class="table-wrapper mx-auto">
            <table class="table table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> Id</th>
                        <th><i class="fas fa-tag"></i> Nom</th>
                        <th><i class="fas fa-user"></i> Prénom</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-phone"></i> Téléphone</th>
                        <th><i class="fas fa-ticket-alt"></i> Abonnement</th>
                        <th><i class="fas fa-user-cog"></i> Rôle</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
<tbody>
                   <?php foreach ($Adherents as $adh): ?>
                    <tr>
                        <td><?= esc($adh['IdAdherents']) ?></td>
                        <td><?= esc($adh['Nom']) ?></td>
                        <td><?= esc($adh['Prenom']) ?></td>
                        <td><?= esc($adh['AdresseMail']) ?></td>
                        <td><?= esc($adh['NumeroTel']) ?></td>
                        <td><?= esc($adh['idAbonnement']) ?></td>
                        <td><?= esc($adh['Role']) ?></td>
                        <td>
                            <form action="/Adherents/ModifierAdherent/<?= esc($adh['IdAdherents']) ?>" method="get" class="d-inline">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                            </form>
                           <form action="<?= base_url('/Adherents/supprimer') ?>" method="post" style="display:inline;">
                                <input type="hidden" name="IdAdherents" value="<?= esc($adh['IdAdherents']) ?>">
                                    <button type="submit" style="background-color:red; color:white; border:none; padding:5px 10px;">Supprimer
                            </button>
                        </form>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="<?= site_url('/Adherents/AjouterAdherent')?>" class="btn btn-primary mt-3">
                <i class="fas fa-plus"></i> Ajouter un adhérent
            </a>
        </div>
    </div>
</body>
</html>