<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - Hyrst</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <li class="nav-item"><a class="nav-link active" href="contact">Contact</a></li>
                    <?php if(session()->get('Role') === 1): ?>
                        <li class="nav-item"><a class="nav-link" href="Adherents">Liste Adhérents</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="home">Accueil</a></li>
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
    <!-- Conteneur du formulaire de contact -->
    <div class="container contact-container">
        <h1 class="contact-header">Nous Contacter</h1>
        <p class="text-center text-muted">Remplissez le formulaire ci-dessous et nous vous répondrons rapidement.</p>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        <form id="contact-form" method="POST" action="contact.php">
            <div class="mb-3">
                <label for="Sujet" class="form-label">Sujet</label>
                <input type="text" class="form-control" id="Sujet" name="Sujet" placeholder="Sujet de votre Message" required>
            </div>
            <div class="mb-3">
                <label for="Message" class="form-label">Message</label>
                <textarea class="form-control" id="Message" name="Message" rows="5" placeholder="Écrivez votre Message ici" required></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Envoyer le Message</button>
            </div>
        </form>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>