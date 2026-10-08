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

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class CacheHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        
        // Menggunakan extension PHPRedis bawaan PHP
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1', 6379);
        // $this->redis->auth('password_jika_ada');
    }

    public function getData_byModule($module_kode, $company_id)
    {
        $cacheKey = 'api:' . $module_kode . ':company_' . $company_id;

        // 1. Cek di Redis
        // if ($this->redis->exists($cacheKey)) {
            $data = $this->redis->get($cacheKey);
            return $this->response->setJSON([
                'status' => true,
                'source' => 'REDIS_NATIVE',
                'data'   => json_decode($data, true)
            ]);
        // }
    }

    public function saveData_byModule($module_kode, $company_id, $response)
    {
        // 2. Ambil dari API / DB jika tidak ada di Redis
        // $apiResponse = $this->fetchDataFromExternalApi();

        // if ($apiResponse) {
            // 3. Simpan ke Redis dengan TTL 1 jam (3600 detik)
            $this->redis->setex($cacheKey, 3600, json_encode($apiResponse));
        // }

        return $this->response->setJSON([
            'status' => true,
            'source' => 'EXTERNAL_API',
            'data'   => $apiResponse
        ]);
    }
}
