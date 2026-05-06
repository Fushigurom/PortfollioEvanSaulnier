<?php
require_once('fonctions.php');

class Adhérent {
    private $db;
    private $IdAdherents;
    private $Nom;
    private $Prenom;
    
    public function __construct($a = null, $n = null, $p = null) {
        $this->db = connect_bd('ap2'); // Initialisation de la connexion à la base de données
        
        if ($n != null || $p != null) {
            $this->IdAdherents = $a;
            $this->Nom = $n;
            $this->Prenom = $p;
        }
    }
    public function countAdherents() {
        $sql = "SELECT COUNT(*) AS total FROM adhérents";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    // Getters
    public function getIdAdhérent() {
        return $this->IdAdherents;
    }

    public function getNom() {
        return $this->Nom;
    }

    public function getPrenom() {
        return $this->Prenom;
    }

    // Setters
    public function setIdAdhérent($IdAdherents) {
        $this->IdAdherents = $IdAdherents;
    }

    public function setNom($Nom) {
        $this->Nom = $Nom;
    }

    public function setPrenom($Prenom) {
        $this->Prenom = $Prenom;
    }

    // Récupérer tous les adhérents
    public function getAllAdhérents() {
        $stmt = $this->db->query("SELECT * FROM adhérents");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Adhérent');
    }

    // Supprimer un adhérent
    public function deleteAdhérent($id) {
        $sql = "DELETE FROM adhérents WHERE IdAdherents = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function getAdhérentById($id) {
        $sql = "SELECT * FROM adhérents WHERE IdAdherents = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ); // Retourne un objet avec les données de l'adhérent
    }
    public function updateAdhérent($id, $nom, $prenom) {
        $sql = "UPDATE adhérents SET Nom = ?, Prenom = ? WHERE IdAdherents = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $prenom, $id]);
    }
}
?>
