<?php

class CriptoController
{
    const KEY = LLAVE_SAIA_CRYPTO;

    /**
     * aplica doble codificacion md5 a un string
     *
     * @param string $data
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-08
     */
    public static function encrypt_md5($data)
    {
        return md5(md5($data));
    }

    /**
     * encripta un string en base a una llave dada
     *
     * @param string $data
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-08
     */
    public static function encrypt_blowfish($data)
    {
        $key = self::KEY;
        
        if (function_exists("mcrypt_encrypt")) {
            $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            $crypttext = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_CBC, $iv);
            return trim(bin2hex($iv . $crypttext));
        } else {
            $encoded_openssl = self::openssl_blowfish_encrypt_hex_cbc($key, $data);
            return $encoded_openssl;
        }
    }

    /**
     * descripta una cadena en base a una llave
     *
     * @param string $data
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-08
     */
    public static function decrypt_blowfish($data)
    {
        $key = self::KEY;

        if (function_exists("mcrypt_decrypt")) {
            $iv = pack("H*", substr($data, 0, 16));
            $x = pack("H*", substr($data, 16));
            $res = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $x, MCRYPT_MODE_CBC, $iv);
        } else {
            $res = self::openssl_blowfish_decrypt_hex_cbc($key, $data);
        }
        return trim($res);
    }

    public static function make_openssl_blowfish_key($key)
    {
        if ("$key" === '') {
            return $key;
        }
        $len = (16 + 2) * 4;
        while (strlen($key) < $len) {
            $key .= $key;
        }
        $key = substr($key, 0, $len);
        return $key;
    }

    public static function openssl_blowfish_encrypt_hex_cbc($key, $str)
    {
        $blockSize = 8;
        $len = strlen($str);
        $paddingLen = intval(($len + $blockSize - 1) / $blockSize) * $blockSize - $len;
        $padding = str_repeat("\0", $paddingLen);
        $data = $str . $padding;
        $key = self::make_openssl_blowfish_key($key);

        //$iv_size = openssl_cipher_iv_length('BF-CBC');
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('BF-CBC'));
        $encrypted = openssl_encrypt($data, 'BF-CBC', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
        return bin2hex($iv . $encrypted);
    }

    public static function openssl_blowfish_decrypt_hex_cbc($key, $hex)
    {
        $key = self::make_openssl_blowfish_key($key);
        $iv = pack("H*", substr($hex, 0, 16));
        $data = pack("H*", substr($hex, 16));

        $decrypted = openssl_decrypt($data, 'BF-CBC', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
        return trim($decrypted);
    }

    /**
     * genera una cadena aleatoria
     *
     * @param integer $length
     * @param boolean $uc
     * @param boolean $n
     * @param boolean $sc
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-08
     */
    public static function randomString($length = 10, $uc = true, $n = true, $sc = false)
    {
        $source = 'abcdefghijklmnopqrstuvwxyz';

        if ($uc){
            $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        if ($n){
            $source .= '1234567890';
        }

        if ($sc == 1){
            $source .= '|@#~$%()=^*+[]{}-_';
        }

        if ($length) {
            $rstr = "";
            $source = str_split($source, 1);
            for ($i = 1; $i <= $length; $i++) {
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1, count($source));
                $rstr .= $source[$num - 1];
            }
        }
        return $rstr ?? '';
    }
}
