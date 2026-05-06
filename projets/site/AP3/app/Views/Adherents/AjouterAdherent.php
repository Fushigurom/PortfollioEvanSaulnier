<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un utilisateur</title>
</head>
<body>

  <h1>Ajouter un utilisateur</h1>

  <form action="<?= base_url("/Adherents/Ajouter")?>" method="post">
    
    <label for="Nom">Nom :</label><br>
    <input type="text" id="Nom" name="Nom" required><br><br>

    <label for="Prenom">Prénom :</label><br>
    <input type="text" id="Prenom" name="Prenom" required><br><br>

    <label for="AdresseMail">Email :</label><br>
    <input type="email" id="AdresseMail" name="AdresseMail" required><br><br>

    <label for="Motdepasse">Mot de passe :</label><br>
    <input type="password" id="Motdepasse" name="Motdepasse" required><br><br>

    <label for="NumeroTel">Numéro de téléphone :</label><br>
    <input type="tel" id="NumeroTel" name="NumeroTel" required><br><br>

    <button type="submit">Ajouter</button>
  </form>

</body>
</html>