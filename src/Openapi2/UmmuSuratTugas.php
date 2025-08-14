<?php

namespace Dorbitt\Openapi2;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\GlobalHelper;

class UmmuSuratTugas
{
    public function __construct()
    {
        $this->curli = new CurlHelper();
        $this->gHelp = new GlobalHelper();

        $this->kode = "surat_tugas";
        
        $this->path = 'api/hcm/'.$this->kode.'/';
    }

    public function show($params)
    {
        $id = $params['id'];

        if ($id) {
            $show = "show/".$id;
        }else{
            $show = "show";
        }

        $response = $this->curli->request4(
            [
                "path"           => $this->path . $show,
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function insert($params)
    {
        $response = $this->curli->request4([
            "path"           => $this->path. "create",
            "method"         => "POST",
            "payload"        => $params["payload"],
            "module_code"    => $this->kode,
            "token"          => $params["token"]
        ]);

        return json_decode($response, false);
    }

    public function delete($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->path. "delete",
                "method"         => "DELETE",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function update($params)
    {
        $id = $params['id'];

        $response = $this->curli->request4(
            [
                "path"           => $this->path. "update/". $id,
                "method"         => "PUT",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function release($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->path. "release",
                "method"         => "POST",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function approve($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->path. "approve",
                "method"         => "POST",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function update_release($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->path. "update_release",
                "method"         => "PUT",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }



    /**
     * UPDATE STATUS ZONE*/
    public function zoneprocess_show($params)
    {
        $id = $params['id'];

        if ($id) {
            $show = "show/".$id;
        }else{
            $show = "show";
        }

        $response = $this->curli->request4(
            [
                "path"           => $this->path_process . $show,
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode_process,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }



    /**
     * CREATE ZONE*/
    public function zonecreate_show($params)
    {
        $id = $params['id'];

        if ($id) {
            $show = "show/".$id;
        }else{
            $show = "show";
        }

        $response = $this->curli->request4(
            [
                "path"           => $this->path_create . $show,
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode_create,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }



    /**
     * MONITORING ZONE*/
    public function monitoring_show()
    {
        // 
    }
}
