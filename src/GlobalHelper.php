<?php

namespace Dorbitt;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\File;

class GlobalHelper 
{
    public function __construct()
    {
        //
        $this->request = \Config\Services::request();
    }

    public function dtFormatter($data)
    {
        return date('Y-m-d H:i:s', strtotime(str_replace('.', '/', $data)));
    }

    public function dateFromFormatter($data)
    {
        return date('Y-m-d', strtotime(str_replace('.', '/', $data)));
    }

    public function timeFromFormatter($data)
    {
        return date('H:i:s', strtotime(str_replace('.', '/', $data)));
    }

    public function dateToFormatter($data)
    {
        return date('Y-m-d', strtotime(str_replace('.', '/', $data)));
    }

    public function timeToFormatter($data)
    {
        return date('H:i:s', strtotime(str_replace('.', '/', $data)));
    }

    public function dtfFormatter($data)
    {
        if ($data) {
            $strtotime = strtotime(str_replace('.', '/', $data));
            // $date = date('Y-m-d', $strtotime);
            // $time = date('H:i:s', $strtotime);

            return date('Y-m-d H:i:s', $strtotime);
        }
    }

    public function dttFormatter($data)
    {
        if ($data) {
            $strtotime = strtotime(str_replace('.', '/', $data));
            $date = date('Y-m-d', $strtotime);
            $time = date('H:i:s', $strtotime);
            if ($time == '00:00:00') {
                $time = '23:59:59';
                $dtt = $date.' '.$time;
            }else{
                $dtt = date('Y-m-d H:i:s', $strtotime);
            }


            return $dtt;
        }
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

        $filepath = '';
        if ($filez->getBasename()) {
            if (! $file->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $file->store();
            }
        }

        return $filepath;
    }

    public function savefile_fromurl($url)
    {
        if ( !is_dir( WRITEPATH . 'downloads') ) {
            mkdir( WRITEPATH . 'downloads' );
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

            $newName = random_string('alnum', 40).'.'.$extension;
            // Initialize a file URL to the variable 
              
            // Initialize the cURL session 
            $ch = curl_init($url); 

            // Initialize directory name where 
            // file will be save 
            $dir = WRITEPATH.'downloads/'; 

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

    public function disc($jml, $prc)
    {
        $text = $jml * prc / 100;
        return $text;
    }
}