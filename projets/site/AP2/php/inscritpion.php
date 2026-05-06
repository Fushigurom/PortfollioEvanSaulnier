<?php
// inclure les fonctions pour la base
include ("fonctions.php");
// insertion de données
$cnx = connect_bd('ap2');
if($cnx) {
    
    // on prépare la requête (une seule fois)
    $result = $cnx->prepare('INSERT INTO adhérents (Prenom, Nom, AdresseMail, NumeroTel, Motdepasse)
    VALUES (:Prenom, :Nom, :AdresseMail, :NumeroTel, :Motdepasse)');
    $Verif = $cnx->prepare('SELECT AdresseMail FROM adhérents WHERE AdresseMail=:AdresseMail');
    $email = filter_input(INPUT_POST, "AdresseMail");
    $Verif->bindParam(':AdresseMail', $email, PDO::PARAM_STR);
    $Verif->execute();
    if (!$verification = $Verif->fetch()) {
        // On affecte aux variables les valeurs des données postées du formulaire
        $prenom = filter_input (INPUT_POST,"Prenom");
        $nom = filter_input (INPUT_POST, "Nom");
        $email = filter_input (INPUT_POST, "AdresseMail");
        $motdepasse = password_hash(filter_input(INPUT_POST, "Motdepasse"), PASSWORD_DEFAULT);
        $numerotel = filter_input (INPUT_POST, "NumeroTel");
        //$messageClient = filter_input (INPUT_POST, "message");
        // On lie chaque marqueur à une variable en précisant le type de données
        $result->bindParam(':Prenom',$prenom, PDO::PARAM_STR);
        $result->bindParam(':Nom',$nom, PDO::PARAM_STR);
        $result->bindParam(':AdresseMail',$email, PDO::PARAM_STR);
        $result->bindParam(':Motdepasse',$motdepasse, PDO::PARAM_STR);
        $result->bindParam(':NumeroTel',$numerotel, PDO::PARAM_STR);
        //$result->bindParam(':message',$messageClient, PDO::PARAM_STR);
        // On exécute la requête
        if ($result->execute()) {
            echo '<p>' . $result->rowCount() . ' Votre compte a été créé. ID : ' . $cnx->lastInsertId() . '</p>';
            header('Location: ../pages/connexion.html');
            
            exit();
        } else {
            echo  '<p>Erreur lors de l\'inscription. Veuillez réessayer.</p>';
        }   
    } else { echo "er";}
}
deconnect_bd('ap2');
?>
