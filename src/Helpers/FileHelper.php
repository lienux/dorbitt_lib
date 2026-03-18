<?php

namespace Dorbitt\Helpers;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\File;
use CodeIgniter\I18n\Time;

class FileHelper 
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    }

    public function upload_attachefile()
    {
        $file = $this->request->getFile('attachefile');
        // $validationRule = [
        //     'attachefile' => [
        //         'label' => 'Image File',
        //         'rules' => [
        //             'uploaded[attachefile]',
        //             'is_image[attachefile]',
        //             'mime_in[attachefile,image/jpg,image/jpeg,image/gif,image/png,image/webp,pdf]',
        //             'max_size[attachefile,500]',
        //             // 'max_dims[foto_mahasiswa,1024,768]',
        //         ],
        //     ],
        // ];

        
        // if (! $this->validate($validationRule)) {
        //     $data = [
        //         'status'        => false,
        //         'errors'        => $this->validator->getErrors()
        //     ];
        //     return $this->respond($data, 200);
        // }

        // if ($file->isValid()) {

            if (! $file->hasMoved()) {

                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/attachfile/', $newName);
                $data = [
                    'status'        => true,
                    'name'          => $newName,
                    'filepath'      => FCPATH . 'uploads/attachfile/'. $newName,
                    'fileurl'       => base_url() . 'uploads/attachfile/'. $newName,
                ];

                return $data;
            }
            // else
            // {
            //     throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
            // }
        // }
    }

    public function upload()
    {
        $file       = $this->request->getFile('file');
        $filez      = new \CodeIgniter\Files\File($file);

        $name = $file->getName();
        $originalName = $file->getClientName();
        $tempfile = $file->getTempName();
        $ext   = $file->getClientExtension();
        $type = $file->getClientMimeType();      
        // $clientPath = $file->getClientPath(); //this is for ci 4.4.0

        $filepath = '';
        if ($filez->getBasename()) {
            if (! $file->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $file->store();
            }
        }

        return $filepath;
    }

    public function file_update()
    {
        // 1. Validasi Input
        $validationRule = [
            'file_upload' => [
                'rules' => 'uploaded[file_upload]'
                    . '|ext_in[file_upload,pdf,doc,docx,jpg,jpeg,png,gif]' // Tambahkan ekstensi di sini
                    . '|max_size[file_upload,1024]',
                'label' => 'File Upload',
            ],
        ];

        // if (!$this->validate($validationRule)) {
        //     // return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        //     return $this->validator->getErrors();
        // }

        // $this->validation->setRules($validationRule);
        // $this->validation->withRequest($this->request)->run();
        // $errors = $this->validation->getErrors();
        //     if($errors) return $errors;

        // 2. Ambil File
        $file = $this->request->getFile('file_upload');
        
        if ($file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $folder = date('Ymd');

                // the original filename
                $originName = $file->getName();

                $tempfile = $file->getTempName();
                $ext = $file->getClientExtension();
                $type = $file->getClientMimeType();

                // // Berikan nama acak agar tidak bentrok
                // $newName = $file->getRandomName();
                
                // // Pindahkan ke folder public/uploads (buat foldernya dulu!)
                // $file->move(FCPATH . 'uploads', $newName);

                // Store Files method
                $path = $file->store();

                // Ambil hanya nama filenya (misal: 1716182405_a1b2c3.pdf)
                $pathFileName = basename($path);

                $data = [
                    'fileNameOrigin' => $originName,
                    'fileName' => $pathFileName,
                    'fileExten' => $ext,
                    'folder' => $folder,
                    'filePath' => $path,
                    'fileUrl' => base_url('uploads/' . $path)
                ];

                return $data;
            }
        }
    }

    public function saveFile_import()
    {
        $file = $this->request->getFile('file');
        $filez = new \CodeIgniter\Files\File($file);

        $importPath = WRITEPATH . 'import/';
        $destination = $importPath . date('Ymd') . '/';

        if (!is_dir($importPath)) {
            mkdir($importPath);
        }

        if (!is_dir($destination)) {
            mkdir($destination);
        }

        $name = $file->getName();
        $originalName = $file->getClientName();
        $tempfile = $file->getTempName();
        $ext = $file->getClientExtension();
        $type = $file->getClientMimeType();      
        // $clientPath = $file->getClientPath(); //this is for ci 4.4.0

        // $filepath = '';
        // if ($filez->getBasename()) {
        //     if (! $file->hasMoved()) {
        //         // $filepath = WRITEPATH . 'import/' . $file->store();
        //         $filepath = WRITEPATH . 'import/' . $file->store();
        //     }
        // }

        // return $filepath;

        if ($filez->getBasename()) {
            if (! $file->hasMoved()) {
                $newName = $originalName . '_' .$file->getRandomName();

                $file->move($destination, $newName);

                // $data = [
                //     'status'        => true,
                //     'name'          => $newName,
                //     'filepath'      => WRITEPATH . 'uploads/attachfile/'. $newName,
                //     'fileurl'       => base_url() . 'uploads/attachfile/'. $newName,
                // ];

                // return $data;
                
                $insert = $this->mImport
                ->insert([
                    "company_id"    => $this->identity->company_id(),
                    "filename"      => $newName,
                    "path"          => $destination . $newName,
                    "created_by"    => $this->identity->account_id()
                ]);

                return $insert;
            }
            // else{
            //     throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
            // }
        }
        // else{
        //     return false;
        // }
    }

    public function savefile_fromurl($url)
    {
        if ( !is_dir( WRITEPATH . 'downloads/' . date('Ymd')) ) {
            mkdir( WRITEPATH . 'downloads/' . date('Ymd'));
        }

        $extension  = pathinfo($url, PATHINFO_EXTENSION);
        $dirname    = pathinfo($url, PATHINFO_DIRNAME);
        $basename   = pathinfo($url, PATHINFO_BASENAME);
        $filename   = pathinfo($url, PATHINFO_FILENAME);

        if (strlen($extension) > 0) {

            // $path_parts = pathinfo($url);
            // $dirname    = $path_parts['dirname'];
            // $basename   = $path_parts['basename'];
            // $extension  = $path_parts['extension'];
            // $filename   = $path_parts['filename'];

            // $newName = random_string('alnum', 40).'.'.$extension;
            $newName = $this->newName() . '.' . $extension;
            // Initialize a file URL to the variable 
              
            // Initialize the cURL session 
            $ch = curl_init($url); 

            // Initialize directory name where 
            // file will be save 
            $dir = WRITEPATH . 'downloads/' . date('Ymd') . '/'; 

            // Use basename() function to return 
            // the base name of file 
            // $file_name = basename($url); 

            // Save file into file location 
            $save_file_loc = $dir . $newName; 

            // Open file 
            $fp = fopen($save_file_loc, 'wb'); 

            // It set an option for a cURL transfer 
            curl_setopt($ch, CURLOPT_FILE, $fp); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 

            // Perform a cURL session 
            curl_exec($ch); 

            // Closes a cURL session and frees all resources 
            curl_close($ch); 

            // Close file 
            fclose($fp); 

            // $response = [
            //     // "filename"          => $newName,
            //     // "dir"               => $dir,
            //     "src"               => $dir.$newName
            // ];

            return $dir.$newName;
        }
    }

    public function newName()
    {
        $newName = Time::now()->getTimestamp() . '_' . bin2hex(random_bytes(10));

        return $newName;
    }
}