<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtHelper
{
    private static $secretKey;

    public static function init()
    {
        self::$secretKey = getenv('JWT_SECRET');
    }

    public static function createToken($data, $expiration)
    {
        self::init();
        
        $issuedAt = time();
        $payload = [
            'iat'  => $issuedAt,
            'exp'  => $issuedAt + $expiration,
            'data' => $data
        ];

        return JWT::encode($payload, self::$secretKey, 'HS256');
    }

    public static function decodeToken($token)
    {
        self::init();

        try {
            return JWT::decode($token, new Key(self::$secretKey, 'HS256'));
        } catch (Exception $e) {
            return null;
        }
    }
}
