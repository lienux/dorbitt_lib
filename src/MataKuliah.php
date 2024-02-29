<?php

namespace Dorbitt;

use Dorbitt\Curl;

class MataKuliah
{
    public function __construct()
    {
        $this->curli = new Curl();
    }

    public function show($params)
    {
        $id = $params['id'];
        $payload = $params['payload'];
        $token = $params['token'];
        
        if ($id) {
            $path = "api/siakad/mata_kuliah/show/" . $id;
        }else{
            $path = "api/siakad/mata_kuliah/show";
        }

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "mata_kuliah",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }

    public function create($params)
    {
        // $id = $params['id'];
        $payload = $params['payload'];
        $token = $params['token'];
        
        $path = "api/siakad/mata_kuliah/create";

        $params = [
            "path"           => $path,
            "method"         => "POST",
            "payload"        => $payload,
            "module_code"    => "mata_kuliah",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }

    public function update($params)
    {
        $id = $params['id'];
        $payload = $params['payload'];
        $token = $params['token'];
        
        $path = "api/siakad/mata_kuliah/update/".$id;

        $params = [
            "path"           => $path,
            "method"         => "PUT",
            "payload"        => $payload,
            "module_code"    => "mata_kuliah",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }

    public function delete($params)
    {
        $id = $params['id'];
        $payload = $params['payload'];
        $token = $params['token'];
        
        if ($id) {
            $path = "api/siakad/mata_kuliah/delete/" . $id;
        }else{
            $path = "api/siakad/mata_kuliah/delete";
        }

        $params = [
            "path"           => $path,
            "method"         => "DELETE",
            "payload"        => $payload,
            "module_code"    => "mata_kuliah",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }
}
