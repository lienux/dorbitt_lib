<?php

namespace App\Controllers\MyGallery;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Dorbitt\UmmuPhotos;

class PhotosController extends ResourceController
{
    public function __construct()
    {
        $this->request  = \Config\Services::request();
        $this->ummu = new UmmuPhotos();
    }

    public function index()
    {
        // 
    }

    public function show($id = null)
    {
        $limit = $this->request->getVar('limit');
        $offset = $this->request->getVar('offset');
        $sort = $this->request->getVar('sort');
        $order = $this->request->getVar('order');
        $search = $this->request->getVar('search');

        $payload = [
            "limit"     => (int)$limit,
            "offset"    => (int)$offset,
            "sort"      => (string)$sort,
            "order"     => (string)$order,
            "search"    => (string)$search,
            "date"      => [
                "from"  => "",
                "to"    => ""
            ],
            "created_by" => true
        ];

        $params = [
            "id"             => $id,
            "payload"        => $payload,
            "token"          => session()->get('token')
        ];

        $response = $this->ummu->show($params);

        return $this->respond($response, 200);
    }

    public function create()
    {
        $body = $this->request->getJsonVar('body');

        $params = [
            "payload"        => $body,
            "token"          => session()->get('token')
        ];

        $response = $this->ummu->insert($params);

        return $this->respond($response, 200);
    }

    public function do_upload()
    {
        $param_name = $this->request->getFile('file_upload');
        // $folder_name = $this->request->getVar('foldername');
        $validationRule = [
            'file_upload' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[file_upload]',
                    'is_image[file_upload]',
                    'mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[file_upload,500]',
                    // 'max_dims[foto_mahasiswa,1024,768]',
                ],
            ],
        ];

        $file = $this->request->getFile('file_upload');
        
        // if (! $this->validate($validationRule)) {
        //     $data = [
        //         'status'        => false,
        //         'errors'        => $this->validator->getErrors()
        //     ];
        //     return $this->respond($data, 200);
        // }

        if (! $file->hasMoved()) {
            $newName = $file->getRandomName();
            // $file->move(FCPATH . $folder_name . '/', $newName);
            $file->move(FCPATH . 'uploads/', $newName);
            $data = [
                'status'        => true,
                'name'          => $newName,
                // 'filepath'      => base_url() . $folder_name . '/'. $newName,
                'filepath'      => base_url() . 'uploads/'. $newName,
            ];            
            return $this->respond($data, 200);
        }

        $data = [
            'status'        => false,
            'errors'        => 'The file has already been moved.'
        ];

        // $data = [
        //     'status'        => false,
        //     'message'        => $param_name.' / '.$folder_name
        // ];
        return $this->respond($data, 200);
    }

    public function update($id = null)
    {
        // $update = $this->mahasiswaHelper->update($id);
        // return $this->respond($update, 200);
    }

    public function delete($id = null)
    {
        $request = $this->client->request('DELETE',$this->curlHelper->url().'api/berangkas_file/delete/'.$id, [
            'http_errors'   => false,
            'headers'       => $this->curlHelper->headers2('berangkas'),
        ]);

        $body = $request->getBody();
        $body = json_decode($body);

        return $this->respond($body, 200);
    }
}
