<?php

namespace Dorbitt;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

class Curl
{
    public function __construct()
    {
        if (getenv("CI_DORBITT")=="development") {
            $this->url = "http://localhost:8080/";
        }elseif (getenv("CI_DORBITT")=="testing") {
            $this->url = "http://testing-api.dorbitt.com/";
        }else{
            $this->url = "https://api.dorbitt.com/";
        }

        if (getenv("DORBITT_TOKEN")) {
            $this->token = getenv("DORBITT_TOKEN");
        }else{
            $this->token = "";
        }
    }

    public function valcurl()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $curlresult=curl_exec ($ch);
        curl_close ($ch);
        
        if (!preg_match("/OK/i", $curlresult))
        return "The curl action has FAILED! (OUTPUT of curl is: ".$curlresult."), please check your internet connection";
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

    public function request2($params)
    {
        $url            = $params['url'];
        $method         = $params['method'];
        $payload        = $params['payload'];
        $module_code    = $params['module_code'];
        $token          = $params['token'];

        if ($token == null) {
            $token = $this->token;
        }elseif ($token == 'session') {
            $token = session()->get('token');
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
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }

    public function request3($params)
    {
        $path           = $params['path'];
        $method         = $params['method'];
        $payload        = $params['payload'];
        $module_code    = $params['module_code'];
        $token          = $params['token'];

        if ($token == null) {
            $token = $this->token;
        }elseif ($token == 'session') {
            $token = session()->get('token');
        }

        $url_ = $this->url . $path;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_,
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
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function ummu($params)
    {
        $url            = $params['url'];
        $method         = $params['method'];
        $payload        = $params['payload'];
        $headers        = $params['headers'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, false);
    }
}
