<?php
use Firebase\JWT\JWT;

class JwtController
{
    private static $secret_key = LLAVE_SAIA;
    private static $encrypt = ['HS256'];

    public static function SignIn($data)
    {
        $time = time();
        $token = [
            'iat' => $time,
            'exp' => $time + (60 * 60 * 24),
            'aud' => self::Aud(),
            'data' => $data
        ];

        return JWT::encode($token, self::$secret_key);
    }

    public static function Check($token, $userId)
    {
        if (empty($token)) {
            throw new Exception("Invalid token supplied.");
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        if (
            $decode->aud !== self::Aud() ||
            $decode->data->id != $userId ||
            $decode->data->id != $_SESSION['idfuncionario']
        ) {
            throw new Exception("Invalid user logged in.");
        } else {
            return true;
        }
    }

    public static function GetData($token)
    {
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}
