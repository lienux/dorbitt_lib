<?php

namespace Dorbitt\Helpers;

class IescmHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    public function url()
    {
        // if (ENVIRONMENT === 'development') {
        //     return 'http://localhost/hillcon/herp_api/public/';
        // }else{
        //     return 'https://api.escm.my.id/';
        // }
        return getenv('herp_api.url');
    }

    public function headers_login($msdb_token = null)
    {
        if ($msdb_token) {
            $msdbToken = $msdb_token;
        } else {
            $msdb = $this->request->getVar('msdb');
            if ($msdb) {
                $msdb = explode("$$344$$", $msdb);
                $msdbName = $msdb[0];
                $msdbToken = base64_decode($msdb[1]);
            } else {
                $msdbToken = '';
            }
        }

        $headers = [
            'Content-Type: application/json',
            'Msdb-Token: ' . $msdbToken,
            'Company-Token: ' . getenv('company_token')
        ];

        return $headers;
    }

    public function headers_login_jsonVar()
    {
        $msdb = $this->request->getJsonVar('msdb');
        $msdb = explode("$$344$$", $msdb);
        $msdbName = $msdb[0];
        $msdbToken = $msdb[1];

        $headers = [
            'Content-Type: application/json',
            'Msdb-Token: ' . base64_decode($msdbToken),
            'Company-Token: ' . getenv('company_token')
        ];

        return $headers;
    }

    public function headers_sync()
    {
        $msdbToken = session()->get('msdbToken');

        $headers = [
            'Content-Type: application/json',
            'Msdb-Token: ' . base64_decode($msdbToken),
            'Company-Token: ' . getenv('company_token')
        ];

        return $headers;
    }

    /** menggunakan msdbToken saat / dari pas pilihan login menggunakan username dan password  */
    public function headers()
    {
        $headers = [
            'Content-Type: application/json',
            'Msdb-Token: ' . $this->msdbToken(),
            'Authorization: Bearer ' . session()->get('token'),
            'Company-Token: ' . getenv('company_token')
        ];

        return $headers;
    }

    public function msdbToken()
    {
        $msdbToken = session()->get('msdbToken');
        $logged_by = session()->get('logged_by');

        if ($msdbToken) {
            if ($logged_by == "phone") {
                $res = $msdbToken;
            } else {
                $res = base64_decode($msdbToken);
            }
        } else {
            $res = getenv('msdbToken');
        }

        return $res;
    }

    /** menggunakan msdbtoken yg disetting dari master employee openerp ini akan otomatis ketika dia login menggunakan nomer whatsapp,
     *  karna login menggunakan nomer whatsapp tidak ada pilihan msdb */
    public function headers2()
    {
        $headers = [
            'Content-Type: application/json',
            'Msdb-Token: ' . session()->get('msdbTokenEmpl'),
            'Authorization: Bearer ' . session()->get('token'),
            'Company-Token: ' . getenv('company_token')
        ];

        return $headers;
    }

    public function headers_login_shakti()
    {
        $headers = [
            'Content-Type: application/json',
            'App-Id: 8'
        ];

        return $headers;
    }
}