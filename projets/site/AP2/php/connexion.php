<?php
session_start(); // Démarrer la session
include("../php/fonctions.php");
require "../vendor/autoload.php";
use Firebase\JWT\JWT;

$cnx = connect_bd('ap2');

if ($cnx) {
    if (!empty($_POST['AdresseMail']) && !empty($_POST['Motdepasse'])) {
        $Email = filter_input(INPUT_POST, "AdresseMail", FILTER_SANITIZE_EMAIL);
        $MotdePasse = $_POST['Motdepasse'];

        // Préparation de la requête sécurisée
        $q = $cnx->prepare("SELECT * FROM adhérents WHERE AdresseMail = :AdresseMail");
        $q->execute(['AdresseMail' => $Email]);
        $result = $q->fetch();

        if ($result) {
            if (password_verify($MotdePasse, $result['Motdepasse'])) {
                // Stocker les informations essentielles dans la session
                $payload = [
                    'id' => $result['IdAdherents'],
                    "exp" => time() + 3600
                ];
                $_SESSION['user'] = [
                    'Nom' => $result['Nom'],
                    'Prenom' => $result['Prenom'],
                    'AdresseMail' => $result['AdresseMail'],
                    'NumeroTel' => $result['NumeroTel'],
                ];
                
                $jwt = JWT::encode($payload, $key, 'HS256');
                $_SESSION['jwt'] = $jwt;
                // Redirection sécurisée
                header('Location: ../pages/compte.php');
                exit();
            } else {
                $message = "Le mot de passe est incorrect.";
            }
        } else {
            $message = "Le compte <strong>" . htmlspecialchars($Email) . "</strong> n'existe pas.";
        }
    } else {
        $message = "Veuillez compléter tous les champs.";
    }
}

$cnx = null; // Fermeture sécurisée de la connexion
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Hyrst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Connexion</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="AdresseMail" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="Motdepasse" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
    <?php if (!empty($message)): ?>
        <p class="mt-3 text-danger"><?= $message ?></p>
    <?php endif; ?>
</div>
</body>
</html>
