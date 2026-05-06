<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription & Connexion</title>
  <link rel="stylesheet" href="<?= base_url('CSS/ConnexionInscription.css') ?>">
</head>
<body>

  <!-- Formulaire d'inscription -->
  <div class="container" id="inscription">
    <h2>Inscription</h2>
    <form method="post" action="<?= base_url('/Inscription') ?>">
      <label for="Nom">Nom</label>
      <input type="text" id="Nom" name="Nom" required>

      <label for="prenom">Prénom</label>
      <input type="text" id="Prenom" name="Prenom" required>

      <label for="email">Adresse mail</label>
      <input type="email" id="AdresseMail" name="AdresseMail" required>

      <label for="tel">Numéro de téléphone</label>
      <input type="tel" id="NumeroTel" name="NumeroTel" required>

      <label for="password">Mot de passe</label>
      <input type="password" id="Motdepasse" name="Motdepasse" required>

      <button type="submit">S'inscrire</button>
    </form>
  </div>

  <!-- Formulaire de connexion -->
  <div class="container" id="connexion" style="margin-left: 20px;">
    <h2>Connexion</h2>
    <form method="post" action="<?= base_url('/connexion') ?>">
    <form>
      <label for="AdresseMail">Adresse mail</label>
      <input type="email" id="AdresseMail" name="AdresseMail" required>

      <label for="Motdepasse">Mot de passe</label>
      <input type="password" id="Motdepasse" name="Motdepasse" required>

      <button type="submit">Se connecter</button>
    </form>
  </div>

</body>
</html>
