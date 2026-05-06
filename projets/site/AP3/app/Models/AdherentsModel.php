<?php

namespace App\Models;

use CodeIgniter\Model;

class AdherentsModel extends Model
{
    protected $table            = 'Adherents';
    protected $primaryKey       = 'IdAdherents';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["Nom", "Prenom", "AdresseMail", "NumeroTel", "Motdepasse", "idAbonnement", "Role"];

    public function supprimerAdherent($id)
    {
        $db = \Config\Database::connect();

        if (!$id) {
            return false;
        }

        $sql = "EXEC SupprAdherent ?";
        $result = $db->query($sql, [$id]);

        return $result; 
    }
        
    public function GetAllAdherent()
    {
            $db = \Config\Database::connect();
            $query = $this->db->query("EXEC GetAllAdherents");
            return $query->getResultArray(); 
    }
}
