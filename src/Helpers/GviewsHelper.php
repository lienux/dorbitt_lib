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

use CodeIgniter\HTTP\IncomingRequest;
// use CodeIgniter\HTTP\Files\UploadedFile;
// use CodeIgniter\Files\File;
use JShrink\Minifier;

class GviewsHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->minifier = new \JShrink\Minifier();
    }

    public function modal_gallery($themes = null)
    {
        if ($themes == 'niceadmin') {
            return "../../vendor/dorbitt/lib/src/Gviews/partials/modals/gallery_niceAdmin";
        } elseif ($themes == 'sbadmin2') {
            return "../../vendor/dorbitt/lib/src/Gviews/partials/modals/gallery_sbadmin2";
        } else {
            // 
        }
    }

    public function modal_loader()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/modals/loader";
    }

    public function conten_photos()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/contents/mygallery/photos";
    }

    public function modal_confirm()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/modals/confirm";
    }

    public function modal_info()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/modals/information";
    }

    public function modal_list_data($themes = null)
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/modals/list_data";
    }

    public function modal_filter()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/modals/filter";
    }

    public function nav_tab()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/nav_tab";
    }

    public function nav_tab_approve_status()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/nav_tab_approve_status";
    }

    public function nav_tab_doc_status()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/nav_tab_doc_status";
    }

    public function nav_tab_doc_status2()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/partials/nav_tab_doc_status2";
    }

    public function ummujs()
    {
        return $this->minifier->minify(file_get_contents(base_url("vendor/dorbitt-lib/js/ummu.js")));
        // return "OK";
    }

    public function web_data()
    {
        $name = getenv('web.name');
        $favicon = getenv('web.favicon');
        $tmp = getenv('web.tmp');
        $title = getenv('web.title');
        $logo = getenv('web.logo');

        if (!$name) {
            $name = 'ERPNESIA';
        }

        if (!$favicon) {
            $favicon = 'dorbitt_favicon.ico';
        }

        if (!$logo) {
            $logo = 'dorbitt.png';
        }

        if (!$tmp) {
            $tmp = 'arsha';
        }

        if (!$title) {
            $title = 'ERPNESIA';
        }

        $data = [
            "name" => $name,
            "logo" => $logo,
            "favicon" => $favicon,
            "tmp" => $tmp,
            "title" => $title
        ];

        return $data;
    }

    public function partialsInclude()
    {
        return [
            '../../vendor/dorbitt/lib/src/Gviews/partials/modals/loader',
            '../../vendor/dorbitt/lib/src/Gviews/partials/modals/confirm',
            '../../vendor/dorbitt/lib/src/Gviews/partials/modals/information',
            '../../vendor/dorbitt/lib/src/Gviews/partials/modals/gallery_sbadmin2',
            '../../vendor/dorbitt/lib/src/Gviews/partials/modals/list_data',
            '../../vendor/dorbitt/lib/src/Gviews/partials/modals/filter',
        ];
    }

    public function ummujs2()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/ummujs";
    }

    public function ummucssInclude()
    {
        if (getenv('CI_OPENAPI2') == 'development') {
            return "http://localhost/dorbitt/dorbitt_lib/src/Gasset/css/ummu.css?time=" . date('YmdHis');
        }else{
            return "https://cdn.openapi2.com/ummu.css?time=" . date('YmdHis');
        }
    }

    public function ummujsInclude()
    {
        if (getenv('CI_OPENAPI2') == 'development') {
            return "http://localhost/dorbitt/dorbitt_lib/src/Gasset/js/ummu.js?time=" . date('YmdHis');
        }else{
            return "https://cdn.openapi2.com/ummu.js?time=" . date('YmdHis');
        }
    }
}