<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Adherents extends ResourceController
{
    // Fonction pour nettoyer les chaînes et objets en UTF-8
    private function utf8ize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->utf8ize($value);
            }
        } elseif (is_object($data)) {
            foreach ($data as $key => $value) {
                $data->$key = $this->utf8ize($value);
            }
        } elseif (is_string($data)) {
            return mb_convert_encoding($data, 'UTF-8', 'UTF-8');
        }
        return $data;
    }

    // Liste de tous les adhérents
    public function index()
    {
        $adherentmodel = new \App\Models\AdherentsModel();
        $data = $adherentmodel->findAll();
        return $this->respond($this->utf8ize($data));
    }

    // Afficher un adhérent
    public function show($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM Adherents WHERE IdAdherents = ?";
        $query = $db->query($sql, [$id]);
        $result = $query->getRow();

        if (!$result) {    
            return $this->failNotFound("Adherent non trouvée");
        }

        return $this->respond($this->utf8ize($result));
    }

    // Création d'un adhérent
    public function create()
    {
        $json = $this->request->getJSON(true);

        $db = \Config\Database::connect();

        // Appel de la procédure stockée
        $db->query("EXEC CreateAdherent ?, ?, ?, ?, ?, ?, ?", [
            $json['Nom'],
            $json['Prenom'],
            $json['AdresseMail'],
            $json['NumeroTel'],
            password_hash($json['Motdepasse'], PASSWORD_DEFAULT),
            $json['idAbonnement'],
            $json['Role']
        ]);

       
        // Retour JSON
        return $this->respondCreated(["message" => "Adherent créé avec succès"]);
    }

    // Suppression d'un adhérent
    public function delete($id = null)
    {
    $adherentModel = new \App\Models\AdherentsModel();
    if ($adherentModel->delete($id)) {
    return $this->respondDeleted(["message" => "Suppression OK"]);
    }
    return $this->fail("Erreur lors de la suppression");
    }
}
