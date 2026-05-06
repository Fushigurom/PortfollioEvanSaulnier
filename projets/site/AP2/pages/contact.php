<?php
// Démarrer la session
session_start();
require "../php/fonctions.php";
require "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (isset($_SESSION["jwt"])) {
    try {
        $decoded = JWT::decode($_SESSION["jwt"], new Key($key, 'HS256'));
    } catch (Exception $e) {
        session_destroy(); 
    }
}
// Inclure le fichier de connexion à la base de données
include('../php/db_connection.php');
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
    exit();
}
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $Sujet = $_POST['Sujet'];
    $Message = $_POST['Message'];
    $IdAdherents = $decoded->id; // Assurez-vous que cette valeur est définie dans votre session

    // Préparer la requête SQL pour insérer les données dans la table
    $sql = "INSERT INTO message (Sujet, Message, IdAdherents) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $Sujet, $Message, $IdAdherents);

    // Exécuter la requête et vérifier si l'insertion a réussi
    if ($stmt->execute()) {
        $success_message = "Votre Message a été envoyé avec succès !";
    } else {
        $error_message = "Une erreur s'est produite. Veuillez réessayer plus tard.";
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - Hyrst</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css"> <!-- Lien vers votre CSS personnalisé -->
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Hyrst</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="calendrier.php">Calendrier</a></li>
                <li class="nav-item"><a class="nav-link" href="tarifs.php">Tarifs</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="adherentsLister.php">Liste Adhérents</a></li>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="navbar-text text-white me-3"><?= htmlspecialchars($_SESSION['user']['Prenom']) ?></span>
                    <a href="compte.php" class="btn btn-outline-light">Profil</a>
                <?php else: ?>
                    <a href="connexion.html" class="btn btn-outline-light me-2">Connexion</a>
                    <a href="inscription.html" class="btn btn-primary">Inscription</a>
                <?php endif; ?>
            </div>
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
