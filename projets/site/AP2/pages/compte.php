<?php
session_start();
include("../php/fonctions.php");
require "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\key;

if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
    exit();
}
$decoded = JWT::decode($_SESSION['jwt'], new Key($key, 'HS256'));

$cnx = connect_bd('ap2');
$user_id = $decoded->id;
$q = $cnx->prepare("SELECT Nom, Prenom, AdresseMail, NumeroTel FROM adhérents WHERE IdAdherents = :id");
$q->execute(['id' => $user_id]);
$user = $q->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<p>Erreur : Impossible de récupérer les informations du compte.</p>";
    exit();
}
?>

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
        <a class="navbar-brand" href="../index.php">Hyrst</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="calendrier.php">Calendrier</a></li>
                <li class="nav-item"><a class="nav-link" href="tarifs.php">Tarifs</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="adherentsLister.php">Liste Adhérents</a></li>
            </ul>
        <div class="d-flex">
            <span class="navbar-text text-white me-3"><?= htmlspecialchars($user['Prenom']) ?></span>
            <a href="../php/deconnexion.php" class="btn btn-outline-light">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Mon Compte</h1>
    <div class="card mx-auto mt-4" style="max-width: 400px;">
        <div class="card-body">
            <h5 class="card-title text-center">Informations du compte :</h5>
            <p><strong>Nom :</strong> <?= htmlspecialchars($user['Nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($user['Prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['AdresseMail']) ?></p>
            <p><strong>Numéro de téléphone :</strong> <?= htmlspecialchars($user['NumeroTel']) ?></p>
        </div>
    </div>
</div>

</body>
</html>
