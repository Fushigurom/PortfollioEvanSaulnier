<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdherentsModel;

class AuthController extends BaseController
{
    public function ConnexionInscription()
    {
        return view('Auth/ConnexionInscription');
    }

    public function Inscription()
    {
        
        $AdherentsModel = new AdherentsModel();

        $data = [
            'Nom' => $this->request->getPost('Nom'),
            'Prenom' => $this->request->getPost('Prenom'),
            'AdresseMail' => $this->request->getPost('AdresseMail'),
            'NumeroTel' => $this->request->getPost('NumeroTel'),
            'Motdepasse' => password_hash($this->request->getPost('Motdepasse'), PASSWORD_BCRYPT),
            'idAbonnement' => 1,
            'Role' => 0,
        ];

        if ($AdherentsModel->insert($data)) {
            return redirect()->to('/ConnexionInscription')->with('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');
        } else {
            return redirect()->to('/ConnexionInscription')->with('error', 'Erreur lors de l\'inscription. Veuillez réessayer.');
        }
    }

    public function login()
    {
        $AdherentsModel = new AdherentsModel();
        $adherent = $AdherentsModel->where('AdresseMail', $this->request->getPost('AdresseMail'))->first();

        if ($adherent && password_verify($this->request->getPost('Motdepasse'), $adherent['Motdepasse'])) {
            
            session()->set([
                'Nom' => $adherent['Nom'],
                'Prenom' => $adherent['Prenom'],
                'AdresseMail' => $adherent['AdresseMail'],
                'NumeroTel' => $adherent['NumeroTel'],
                'Role' => $adherent['Role'],
                'LoginId' => true,
            ]);
            return redirect()->to('/home');
        } else {
            return redirect()->to('/ConnexionInscription')->with('error', 'Email ou mot de passe incorrect.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/home');
    }

    public function NoAccess()
    {
        return view('Auth/NoAccess');
    }

    public function NoLogin()
    {
        return view('Auth/NoLogin');
    }
}