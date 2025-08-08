<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler
{
    private static $secret_key = 'your_secret_key'; 
    private static $algo = 'HS256';

    
    public static function generateToken($payload)
    {
        return JWT::encode($payload, self::$secret_key, self::$algo);
    }

    
    public static function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(self::$secret_key, self::$algo));
            return (array) $decoded;
        } catch (Exception $e) {
            return false;
        }
    }
}
