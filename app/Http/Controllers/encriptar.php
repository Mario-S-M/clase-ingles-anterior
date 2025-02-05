<?php

namespace App\Http\Controllers;

class encriptar extends Controller
{

    static function encrypt($string)
    {

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'WS-SERVICE-KEY';
        $secret_iv = 'WS-SERVICE-VALUE';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

             $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));

        return $output;
    }


    static function decrypt( $string)
    {
        /* =================================================
         * ENCRYPTION-DECRYPTION
         * =================================================
         * ENCRYPTION: encrypt_decrypt('encrypt', $string);
         * DECRYPTION: encrypt_decrypt('decrypt', $string) ;
         */
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'WS-SERVICE-KEY';
        $secret_iv = 'WS-SERVICE-VALUE';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);


                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);


        return $output;
    }


}