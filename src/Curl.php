<?php

namespace Dorbitt;

class Curl
{
    public function __construct()
    {
        if (getenv("CI_DORBITT")=="testing") {
            $this->url = "http://localhost:8080/";
        }else{
            $this->url = "https://api.dorbitt.com/";
        }

        if (getenv("DORBITT_TOKEN")) {
            $this->token = getenv("DORBITT_TOKEN");
        }else{
            $this->token = "";
        }
    }

    public function request($url,$method,$payload,$module_code,$token = null)
    {
        if ($token == null) {
            $tokenz = $this->token;
        }else{
            $tokenz = $token;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Module-Code: '. $module_code,
                'Authorization: Bearer ' . $tokenz
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }
}
