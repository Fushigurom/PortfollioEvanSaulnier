<?php
session_start();
require_once('../php/adhérents.php');

// Récupération des adhérents via la méthode de la classe Adhérent
$adhérent = new Adhérent();
$adhérents = $adhérent->getAllAdhérents();
$totalAdherents = $adhérent->countAdherents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Adhérents - Hyrst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Hyrst</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="calendrier.php">Calendrier</a></li>
                <li class="nav-item"><a class="nav-link" href="tarifs.php">Tarifs</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link active" href="adherentsLister.php">Liste Adhérents</a></li>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="navbar-text text-white me-3"><?= htmlspecialchars($_SESSION['user']['Prenom'] ?? '') ?></span>
                    <a href="compte.php" class="btn btn-outline-light">Profil</a>
                <?php else: ?>
                    <a href="connexion.html" class="btn btn-outline-light me-2">Connexion</a>
                    <a href="inscription.html" class="btn btn-primary">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="table-container">
        <h1 style="text-align: center;">Liste des Adhérents</h1>
        <h2 style="text-align: center;">Nombre total d'adhérents : <?= $totalAdherents ?></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>idAdhérent</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($adhérents)): ?>
                    <?php foreach ($adhérents as $a): ?>
                        <tr>
                            <td><?= htmlspecialchars($a->getIdAdhérent()) ?></td>
                            <td><?= htmlspecialchars($a->getNom()) ?></td>
                            <td><?= htmlspecialchars($a->getPrenom()) ?></td>
                            <td>
                                <button class="btn btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal"
                                        data-id="<?= $a->getIdAdhérent() ?>"
                                        data-nom="<?= $a->getNom() ?>"
                                        data-prenom="<?= $a->getPrenom() ?>">
                                    Modifier
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="confirmDelete(<?= $a->getIdAdhérent() ?>)">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucun adhérent trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- MODALE POUR MODIFIER UN ADHÉRENT -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifier un adhérent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editNom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="editNom" name="Nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPrenom" class="form-label">Prénom :</label>
                            <input type="text" class="form-control" id="editPrenom" name="Prenom" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Remplir la modale avec les infos de l'adhérent
    document.addEventListener("DOMContentLoaded", function () {
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            document.getElementById('editId').value = button.getAttribute('data-id');
            document.getElementById('editNom').value = button.getAttribute('data-nom');
            document.getElementById('editPrenom').value = button.getAttribute('data-prenom');
        });

        // Gérer la modification via AJAX
        document.getElementById('editForm').addEventListener('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('adherentsModifierTraitement.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload(); // Recharge la page pour voir les modifications
            })
            .catch(error => console.error('Erreur:', error));
        });
    });

    // Confirmation de suppression
    function confirmDelete(id) {
        if (confirm("Voulez-vous vraiment supprimer cet adhérent ?")) {
            fetch('adherentsSupprimer.php?id=' + id, { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload(); // Recharge la page après suppression
            })
            .catch(error => console.error('Erreur:', error));
        }
    }
    </script>
</body>
</html>
