<?php
// Fonction de connexion à la BD
function connect_bd($nomBd)
{
    $nomServeur = 'localhost';
    $login = 'root';
    $passWd = '';

    try {
        $cnx = new PDO("mysql:host=$nomServeur;dbname=$nomBd;charset=utf8", $login, $passWd);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cnx;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

// Fonction de déconnexion de la BD
function deconnect_bd(&$cnx)
{
    $cnx = null;
}

$key = "test";

?>
