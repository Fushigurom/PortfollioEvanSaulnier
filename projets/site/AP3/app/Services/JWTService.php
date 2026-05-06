<?php
namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTService
{
private static function getSecretKey()
{
$key = getenv('JWT_SECRET');
if (!$key) {
throw new \RuntimeException('JWT_SECRET non configuré dans .env');
}
return $key;
}
public static function generateToken($user)
{
$key = self::getSecretKey();
$payload = [
'iss' => 'cine-api',
'aud' => 'api-users',
'iat' => time(),
'exp' => time() + 3600, // 1 heure
'uid' => $user['IdAdherents'],
'email' => $user['AdresseMail']
];
return JWT::encode($payload, $key, 'HS256'); }

public static function generateRefreshToken($user)
{
$key = self::getSecretKey();
$payload = [
'iss' => 'cine-api-refresh',
'aud' => 'api-users',
'iat' => time(),
'exp' => time() + (60 * 60 * 24 * 30), // 30 jours
'uid' => $user['IdAdherents'],
'type' => 'refresh'
];
return JWT::encode($payload, $key, 'HS256');
}
public static function validateToken($token)
{
$key = self::getSecretKey();
try {
return JWT::decode($token, new Key($key, 'HS256'));
} catch (\Exception $e) {
throw new \Exception('Token invalide: ' . $e->getMessage());
}
}
}