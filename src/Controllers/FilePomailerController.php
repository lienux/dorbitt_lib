<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
// use CodeIgniter\Files\File;
// use CodeIgniter\HTTP\Files\UploadedFile;
// use App\Builder\Approval\ApprovalBuilder;
use Dorbitt\Helpers\GviewsHelper;
// use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;

class FilePomailerController extends ResourceController
{
  public $vH;
  public $cH;

  public function __construct()
  {
    $this->kode = 'file_pomailer';
    $this->dir_view = 'pages/' . $this->kode . '/';

    // $this->syshab = \Config\Database::connect('syshab');
    // $this->dorbitt = new DorbitT();
    $this->request = \Config\Services::request();
    // $this->qbAppv = new ApprovalBuilder();
    $this->gViews = new GviewsHelper();
    // $this->gHelp = new GlobalHelper();
    $this->uHelp = new UmmuHelper();
    $this->cH = new CurlHelper();
    $this->vH = new ViewsHelper();
  }

  public function index()
  {
    $crud = $this->uHelp->index($this->kode);
    $data = [
        'navlink' => $this->kode,
        'page_title' => 'List PDF PO Mailer',
        'group' => ['purchasing'],
        // 'tmp' => $this->gHelp->tmp(),
        'module_kode' => $this->kode,
        'dir_views' => $this->dir_view,
        // 'include_tab' => $this->gView->nav_tab_doc_status(),
        'crud' => $crud,
        'rows' => $this->show_file()
    ];

    return view($this->vH->ummuView("pages/purchase/files_pomailer"), $data);
  }

  public function show_file()
  {
    // $directory = './'; // Current directory, change as needed
    // $directory = '/var/www/html/hillcon/escm_mailer/writeable/';
    // Get an array of all directories in the specified path
    // $folders = glob($directory . '/*', GLOB_ONLYDIR);
    // $folders = glob(WRITEPATH . 'create_pdf/*', GLOB_ONLYDIR);
    $folders = glob(FCPATH . 'create_pdf/*', GLOB_ONLYDIR);

    /*// Iterate and print folder names
    foreach ($folders as $folder) {
        // You can use basename() to get just the folder name without the full path
        echo basename($folder) . "<br>";
    }

    // print_r($folders); // This will print the array with full paths
    // var_dump($folders);*/



    // $folders = ['folder1', 'folder2', 'folder3'];
    $allFiles = [];

    foreach ($folders as $value) {
        // Check if the directory exists and glob files matching any pattern (e.g., all files '*')
        if (is_dir($value)) {
            // Glob returns an array of filenames matching the pattern inside the value
            $filesInFolder = glob($value . '/*');
            // Merge the results into the main array
            $allFiles = array_merge($allFiles, $filesInFolder);
            // $allFiles[] = $filesInFolder;
            // array_push($allFiles, $filesInFolder);
        }
    }

    // Display the list of all collected files
    // print_r($allFiles);

    $paths = [];
    foreach ($allFiles as $key => $value) {
      $path = str_replace(FCPATH, '', $value);
      $paths[] = $path;

      // echo '<a href="'.base_url($path).'" target="_blank">'.basename($value).'</a><br>';
      // echo $value.'<br>';
    }

    return $paths;
  }

  public function show($id = null)
  {    
    return $this->respond($this->show_file(), 200);
  }
}
