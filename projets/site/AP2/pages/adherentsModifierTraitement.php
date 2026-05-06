<?php
session_start();
require_once('../php/adhérents.php');

if (!isset($_POST['id']) || !isset($_POST['Nom']) || !isset($_POST['Prenom'])) {
    die("Erreur : Données manquantes.");
}

$adhérent = new Adhérent();
if ($adhérent->updateAdhérent($_POST['id'], $_POST['Nom'], $_POST['Prenom'])) {
    echo "Modification réussie !";
} else {
    echo "Erreur lors de la modification.";
}
?>
