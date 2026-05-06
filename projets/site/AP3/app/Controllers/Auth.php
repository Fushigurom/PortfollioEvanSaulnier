<?php
namespace App\Controllers;

use App\Models\AdherentsModel;
use App\Services\JWTService;
use CodeIgniter\RESTful\ResourceController;
class Auth extends ResourceController
{
     protected $format = 'json';

    /**
     * Convertit toutes les chaînes en UTF-8 pour JSON
     */
    private function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, 'UTF-8', 'auto');
        }
        return $mixed;
    }

    /**
     * Login utilisateur et génération des tokens
     */
    public function login()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[1]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $input = json_decode($this->request->getBody(), true);
        $input = is_array($input) ? $input : [];
        $email = $input['email'] ?? null;
        $password = $input['password'] ?? null;

        $userModel = new AdherentsModel();
        $user = $userModel->where('AdresseMail', $email)->first();

        if (!$user || !password_verify($password, $user['Motdepasse'])) {
            return $this->failUnauthorized('Email ou mot de passe incorrect');
        }

        // Génération des tokens
        $accessToken  = JWTService::generateToken($user);
        $refreshToken = JWTService::generateRefreshToken($user);

        // Convertir le tableau utilisateur en UTF-8
        $user = $this->utf8ize($user);

        return $this->respond([
            'status'  => 'success',
            'message' => 'Connexion réussie',
            'data'    => [
                'access_token'  => $accessToken,
                'refresh_token' => $refreshToken,
                'token_type'    => 'Bearer',
                'expires_in'    => 3600,
                'user'          => [
                    'id'     => $user['IdAdherents'],
                    'email'  => $user['AdresseMail'],
                    'nom'    => $user['Nom'],
                    'prenom' => $user['Prenom'],
                    'role'   => $user['Role']
                ]
            ]
        ]);
    }

    /**
     * Rafraîchir le token d'accès avec le refresh token
     */
    public function refresh()
    {
        $input = json_decode($this->request->getBody(), true);
        $input = is_array($input) ? $input : [];
        $refreshToken = $input['refresh_token'] ?? null;

        if (!$refreshToken) {
            return $this->fail('Refresh token manquant');
        }

        try {
            $decoded = JWTService::validateToken($refreshToken);

            if ($decoded->type !== 'refresh') {
                return $this->failUnauthorized('Token invalide');
            }

            $userModel = new AdherentsModel();
            $user = $userModel->find($decoded->uid);

            if (!$user) {
                return $this->failNotFound('Utilisateur non trouvé');
            }

            $newAccessToken = JWTService::generateToken($user);
            return $this->respond([
                'status' => 'success',
                'data'   => [
                    'access_token' => $newAccessToken,
                    'token_type'   => 'Bearer',
                    'expires_in'   => 3600
                ]
            ]);

        } catch (\Exception $e) {
            return $this->failUnauthorized($e->getMessage());
        }
    }
}