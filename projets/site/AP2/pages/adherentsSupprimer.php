<?php
session_start();
require_once('../php/adhérents.php');

header('Content-Type: text/plain'); // pour que fetch reçoive un texte brut

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo "Erreur : ID adhérent invalide.";
    exit;
}

$adhérent = new Adhérent();

if ($adhérent->deleteAdhérent($_GET['id'])) {
    echo "Adhérent supprimé avec succès.";
} else {
    http_response_code(500);
    echo "Erreur lors de la suppression.";
}
?>
