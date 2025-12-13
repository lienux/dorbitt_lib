<?php

namespace Dorbitt\Helpers;

class EncrypterHelper 
{
    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->request = \Config\Services::request();
    }

    public function encrypt($plainText)
    {
        $ciphertext = $this->encrypter->encrypt($plainText);
        return bin2hex($ciphertext);
    }

    public function decrypt($ciphertext)
    {
        try{
            $hex2bin = hex2bin($ciphertext);
        } catch (\Exception $e) {
            $hex2bin = "";
        }

        try{
            $plainText = $this->encrypter->decrypt($hex2bin);
        } catch (\Exception $e) {
            $plainText = "";
        }
        return $plainText;
    }

    public function syshabEncrypt($plainText)
    {
        $password=strtoupper($plainText);
        $ls_encrypt = '';
        $ls_abjad   = ' ABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+`1234567890-={}[]:";' . "'<>?,./\|";
        $ls_code    = 'FL/X\|MV{}[NEWZ~G!@K#YD$%^AOSH90-J=]UB6C&*I()_+`5<>?T,78: ;"' . "1QR4'2P.3";
        $len = strlen($password);
        For ($ll_loop = 0;  $ll_loop < $len; $ll_loop++ )
        {
            $ls_char  = substr($password, $ll_loop,1);
            $ll_pos   = strpos($ls_abjad, $ls_char,1);
            $ls_char  = substr($ls_code, $ll_pos,1);
            $ls_encrypt = $ls_encrypt."".$ls_char ;
        }
        return $ls_encrypt;
    }

    public function syshabDecrypt($ciphertext)
    {
        $password=strtoupper($ciphertext);
        $ls_decrypt = '';
        $ls_abjad   = ' ABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+`1234567890-={}[]:";' . "'<>?,./\|";
        $ls_code    = 'FL/X\|MV{}[NEWZ~G!@K#YD$%^AOSH90-J=]UB6C&*I()_+`5<>?T,78: ;"' . "1QR4'2P.3";
        $len = strlen($password);
        For ($ll_loop = 0;  $ll_loop < $len; $ll_loop++ )
        {
            $ls_char  = substr($password,$ll_loop,1);
            $ll_pos   = strpos($ls_code,$ls_char,1);
            $ls_char  = substr($ls_abjad,$ll_pos,1);
            $ls_decrypt = $ls_decrypt . $ls_char;
        }
        return $ls_decrypt;
    }
    
}