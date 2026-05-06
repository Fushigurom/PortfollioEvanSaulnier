    <?php
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
            <a class="navbar-brand" href="home">Hyrst</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                        <?php if(session()->get('LoginId')): ?>
                <li class="nav-item"><a class="nav-link" href="home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link active" href="calendrier">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="tarifs">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact">Contact</a></li>
                   <?php if(session()->get('Role') === 1): ?>
                        <li class="nav-item"><a class="nav-link" href="Adherents">Liste Adhérents</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link active" href="calendrier">Calendrier</a></li>
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
        <h1 class="text-center mb-4">Calendrier de la chaine Hyrst</h1>

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
                <p>Début du Live a 20H.</p>
                    <?php if (isset($_SESSION['user'])): ?>
                        <form method="post" href = "participerLive.php" action="liveSpecial.php" onsubmit="return confirmerParticipation();">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user']['Prenom']) ?>">
                            <button type="submit" class="btn btn-danger mt-2">Participer au live spécial hebdomadaire</button>
                        </form>
                    <?php else: ?>
                    <p><em><a href="connexion.html">Connectez-vous</a> pour participer au live spécial.</em></p>
                    <?php endif; ?>
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

    <script>
        function confirmerParticipation() {
        return confirm("Souhaitez-vous vraiment participer au live spécial de samedi ?");
        }
    </script>

    </html>
