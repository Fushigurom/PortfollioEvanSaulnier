<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un utilisateur</title>
</head>
<body>

  <h1>Modifier l'Adherent</h1>

 <form action="<?= base_url("/Adherents/update")?>" method="post">

    <input type="hidden" name="IdAdherents" value="<?= $Adherents['IdAdherents'] ?>">

    <label for="Nom">Nom :</label><br>
    <input type="text" id="Nom" name="Nom" value="<?= $Adherents['Nom'] ?>" required><br><br>

    <label for="Prenom">Prénom :</label><br>
    <input type="text" id="Prenom" name="Prenom" value="<?= $Adherents['Prenom'] ?>" required><br><br>

    <label for="AdresseMail">Email :</label><br>
    <input type="email" id="AdresseMail" name="AdresseMail" value="<?= $Adherents['AdresseMail'] ?>" required><br><br>

    <label for="Motdepasse">Mot de passe :</label><br>
    <input type="password" id="Motdepasse" name="Motdepasse" value="<?= $Adherents['Motdepasse'] ?>" required><br><br>

    <label for="NumeroTel">Numéro de téléphone :</label><br>
    <input type="tel" id="NumeroTel" name="NumeroTel" value="<?= $Adherents['NumeroTel'] ?>" required><br><br>

    <label for="idAbonnement">idAbonnement :</label><br>
    <input type="tel" id="idAbonnement" name="idAbonnement" value="<?= $Adherents['idAbonnement'] ?>" required><br><br>

    <button type="submit">Modifier</button>
</form>


</body>
</html>