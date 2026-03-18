<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Dorbitt\Curl;
use App\Builder\GlobalBuilder;
use App\Builder\PhotosBuilder;
use Dorbitt\Helpers\GviewsHelper;

class PhotosController extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->curl = new Curl();
        $this->gBuilder = new GlobalBuilder();
        $this->qBuilder = new PhotosBuilder();
        $this->gViews = new GviewsHelper();
    }

    public function index()
    {
        $data = [
            'navlink' => 'gallery_photos',
            'page_title' => 'Gallery Photos',
            'group' => ['mygallery'],
            'photos' => $this->gViews->conten_photos(),
        ];

        return view('pages/gallery_photos/index', $data);
    }

    // public function show($id = null)
    // {
    //     $builder = $this->qBuilder->show($id);

    //     return $this->respond($builder, 200);
    // }
}
