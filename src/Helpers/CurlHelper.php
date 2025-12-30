<?php

namespace Dorbitt\Helpers;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

class CurlHelper
{
    public $host_api;
    public $url;
    public $token;

    public function __construct()
    {
        $v = "v1/";
        $openapi2URL = getenv("CI_OPENAPI2");

        /*if (getenv("CI_OPENAPI2_CUSTOM")) {
            $this->url = getenv("CI_OPENAPI2_CUSTOM"). $v;
        }else{
            if (getenv("CI_OPENAPI2_PRIVATE")) {
                $this->url = 'https://'.getenv('CI_OPENAPI2_PRIVATE').".openapi2.com/". $v;
            }else{
                if (getenv("CI_OPENAPI2")=="development") {
                    $this->url = "http://localhost:8080/". $v;
                }elseif (getenv("CI_OPENAPI2")=="staging") {
                    $this->url = "https://staging.openapi2.com/". $v;
                }else{
                    if (getenv("CI_OPENAPI2_SPARK") == true) {
                        $this->url = "https://spark.openapi2.com/". $v;
                    }else{
                        $this->url = "https://openapi2.com/". $v;
                    }
                }
            }
        }*/

        if ($openapi2URL == "development") {
            $this->url = "http://localhost:8080/";
            $this->host_api = "http://localhost:8080/";
        // }elseif ($openapi2URL == "staging") {
            // $this->host_api = "https://staging.openapi2.com/";
        }else{
            $this->url = "https://openapi2.com/";
            $this->host_api = "https://openapi2.com/";
        }

        if (getenv("DORBITT_TOKEN")) {
            $this->token = getenv("DORBITT_TOKEN");
        }else{
            $this->token = "";
        }
    }

    public function api()
    {
        return $this->host_api . 'v1/';
    }

    public function endpoint()
    {
        return $this->host_api . 'v1/';
    }

    public function valcurl()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->host_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $curlresult=curl_exec ($ch);
        curl_close ($ch);
        
        if (!preg_match("/OK/i", $curlresult))
        return "The curl action has FAILED! (OUTPUT of curl is: ".$curlresult."), please check your internet connection, for connection to ".$this->host_api;
    }

    public function ping_host_api()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->host_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $curlresult=curl_exec ($ch);
        curl_close ($ch);
        
        if (!preg_match("/OK/i", $curlresult))
        return "The curl action has FAILED! ". "<p>OUTPUT of curl is: ".$curlresult. "<p>Please check your internet connection, for connection to API Host ".$this->host_api;
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
            CURLOPT_URL => $this->api() . $url,
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
                'Authorization: Bearer ' . $tokenz,
                'Company-Token: ' . getenv('company_token')
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
            CURLOPT_URL => $this->api() . $url,
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
                'Authorization: Bearer ' . $token,
                'Company-Token: ' . getenv('company_token')
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

        $url_ = $this->api() . $path;

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
                'Authorization: Bearer ' . $token,
                'Company-Token: ' . getenv('company_token')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function request4($params)
    {
        $path           = $params['path'];
        $method         = $params['method'];
        $payload        = $params['payload'];
        $module_code    = $params['module_code'];
        $token          = $params['token'];

        if ($token == null) {
            $token = $this->token;
        }

        if ($token == 'session') {
            $token = session()->get('token');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api() . $path,
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
                'Authorization: Bearer ' . $token,
                'Company-Token: ' . getenv('company_token')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /**
     * Full url dari params
     * */
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

    /**
     * url hanya path saja*/
    // CONTOH: 
    // $params = [
    //   "path"      => "company_profile",
    //   "method"    => "GET",
    //   "payload"   => [],
    //   "headers"   => array(
    //     'Content-Type: application/json',
    //     'Company-Token: '.getenv('app.company_token')
    //   )
    // ];
    public function ummu2($params)
    {
        $path           = $params['path'];
        $method         = $params['method'];
        $payload        = $params['payload'];
        $headers        = $params['headers'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api() . $path,
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

        /*// Check for cURL errors
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            // Get the HTTP status code
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            echo "HTTP Status Code: " . $http_code;
            // You can now process the $response string and the $http_code
        }*/

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Close the cURL session
        curl_close($curl);

        if ($http_code == 500) {
            return (object)[
                "status"    => false,
                "messages"   => "db_connection failed @".$this->host_api . " Please contact maintenance support." 
            ];
        } else {
            return json_decode($response, false);
        }
    }

    public function ummu2_v1_20250704($params)
    {
        $path           = $params['path'];
        $method         = $params['method'];
        $payload        = $params['payload'];
        $headers        = $params['headers'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api(). $path,
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

    /**
     * Full url dari params
     * Tanpa SSL
     * auth basic
     * */
    public function ummu3($params)
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
            CURLOPT_FOLLOWLOCATION => false,

            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            // CURLOPT_HTTPHEADER => array(
            //     "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
            //     "Accept-Language:en-US,en;q=0.5"
            // ),
            // CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($payload),
            // CURLOPT_HTTPHEADER => $headers,
            // CURLOPT_HTTPHEADER => array(
            //     'Content-Type: application/json',
            //     'dataType: json',
            //     'Authorization: Basic SENfQUxJOmQzdkhpbGxjb24hISFAIyQl'
            // ),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'dataType: json',
                'Authorization: Basic '.$headers['auth'],
                'Cookie: SAP_SESSIONID_DS4_240=dHhdUh2tXdEt2TNuixRRozsRELMJKBHwrvMAUFaTR3Q%3d; sap-usercontext=sap-client=240',
                'Company-Token: ' . getenv('company_token')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, false);
    }


    /**
     * Full url from params
     * Tanpa SSL
     * auth basic
     * headers from params
     * */
    public function ummu4($params)
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
            CURLOPT_FOLLOWLOCATION => false,

            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, false);
    }

    public function efaktur($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Company-Token: ' . getenv('company_token')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // return $response;

        $newArr = (array)simplexml_load_string($response);

        return $newArr;
    }

    public function efaktur2($url)
    {
        // $url = $this->request->getJsonVar('efaktur_url');
        // $xmlfile = file_get_contents($response); 
        // $data = simplexml_load_string($xmlfile); 
        // $con = json_encode($data); 
        // $newArr = json_decode($con, true);
        
        $xmlfile = file_get_contents($url); 
        $new = simplexml_load_string($xmlfile); 
        $con = json_encode($new); 
        $newArr = json_decode($con, true);

        return $newArr;
    }

    public function form($params)
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

        $url_ = $this->api() . $path;

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
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: multipart/form-data',
                'Module-Code: '. $module_code,
                'Authorization: Bearer ' . $token,
                'Company-Token: ' . getenv('company_token')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
