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

class ViewsHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
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

    public function app()
    {
        $name = getenv('app.name');
        $favicon = getenv('app.favicon');
        $tmp = getenv('app.tmp');
        $title = getenv('app.title');
        $logo = getenv('app.logo');
        $text = getenv('app.text');

        if (!$name) {
            $name = 'CodeIgniter';
        }

        if (!$favicon) {
            $favicon = 'favicon.ico';
        }

        if (!$logo) {
            $logo = 'logo.png';
        }

        if (!$tmp) {
            $tmp = 'sbadmin2';
        }

        if (!$title) {
            $title = 'CodeIgniter';
        }

        $data = [
            "name" => $name,
            "logo" => $logo,
            "favicon" => $favicon,
            "tmp" => $tmp,
            "title" => $title,
            "text" => $text
        ];

        return $data;
    }

    public function partialsInclude()
    {
        return [
            // '../../vendor/dorbitt/lib/src/Views/partials/modals/loader',
            // '../../vendor/dorbitt/lib/src/Views/partials/modals/confirm',
            // '../../vendor/dorbitt/lib/src/Views/partials/modals/information',
            // '../../vendor/dorbitt/lib/src/Views/partials/modals/gallery_sbadmin2',
            // '../../vendor/dorbitt/lib/src/Views/partials/modals/list_data',
            '../../vendor/dorbitt/lib/src/Views/partials/modals',
        ];
    }

    public function ummujs2()
    {
        return "../../vendor/dorbitt/lib/src/Gviews/ummujs";
    }

    public function ummuView($path)
    {
        return "../../vendor/dorbitt/lib/src/Views/" . $path;
    }

    public function stylePath()
    {
        return "plugins/".getenv('app.tmp')."/style";
    }

    public function scriptPath()
    {
        return "plugins/".getenv('app.tmp')."/script";
    }

    public function appTitle()
    {
        $title = getenv('app.title');

        return $title;
    }

    public function appIco()
    {
        $title = getenv('app.favicon');

        if (!$title) {
            $title = 'favicon.ico';
        }

        return $title;
    }
}