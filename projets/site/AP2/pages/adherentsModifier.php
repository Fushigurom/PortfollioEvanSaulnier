<?php
session_start();
require_once('../php/adhérents.php');

if (!isset($_GET['id'])) {
    die("Erreur : ID adhérent manquant.");
}

$adhérent = new Adhérent();
$adh = $adhérent->getAdhérentById($_GET['id']);

if (!$adh) {
    die("Erreur : Adhérent introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Adhérent</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <h2>Modifier Adhérent</h2>
    <form action="adherentsModifierTraitement.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($adh->IdAdherents) ?>">
        <label>Nom:</label>
        <input type="text" name="Nom" value="<?= htmlspecialchars($adh->Nom) ?>" required><br>
        <label>Prénom:</label>
        <input type="text" name="Prenom" value="<?= htmlspecialchars($adh->Prenom) ?>" required><br>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
