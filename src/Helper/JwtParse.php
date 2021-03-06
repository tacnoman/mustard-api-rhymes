<?php

namespace App\Helper;

use Firebase\JWT\JWT;

class JwtParse {
    private static function getKey() {
        $token = getEnv('JWT_TOKEN');
        if (!$token) return 'secret-key';
        return $token;
    }

    public static function encode($data) {
        return JWT::encode($data, self::getKey());
    }

    public static function decode($token) {
        return JWT::decode($token, self::getKey(), ['HS256']);
    }
}
