<?php

class Crypt {

    const ALG = MCRYPT_RIJNDAEL_256;
    const MCRYPT_MODE = MCRYPT_MODE_CBC;

    public static function encode($key = false, $string = array(), $iv = false) {
        
        // Инициализируем вектор
        if (!$iv)$iv = mcrypt_create_iv(mcrypt_get_iv_size(self::ALG, self::MCRYPT_MODE), MCRYPT_RAND);
        
        if(is_array($string)){
            $data = array();
            foreach($string AS $skey => $sval){                
                $data[$skey] = mcrypt_encrypt(self::ALG, $key, $sval, self::MCRYPT_MODE, $iv);
            }
            return array(
            'data' => $data,
            'iv' => $iv,
        );
        }
        else 
        return array(
            'data' => mcrypt_encrypt(self::ALG, $key, $string, self::MCRYPT_MODE, $iv),
            'iv' => $iv,
        );
    }
    

    public static function decode($key = false, $encrypted_string, $iv = false) {
        if (!$iv)
            return false;
        return mcrypt_decrypt(self::ALG, $key, $encrypted_string, self::MCRYPT_MODE, $iv);
    }

}