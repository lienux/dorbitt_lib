<?php

namespace Dorbitt\Config;

/**
 * =============================================
 * Author: Ummu
 * Website: https://ummukhairiyahyusna.com/
 * App: DORBITT LIB
 * Description: 
 * =============================================
 */

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\ViewsHelper;

class Vh extends BaseConfig
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->vHelp = new ViewsHelper();
    }

    public function cVh(string $methodName)
    {
        if (method_exists($this->vHelp, $methodName)) {
            return $this->vHelp->$methodName();
        }
        
        return null;
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
        $a = getenv('app.tmp');
        if (!$a) {
            $a = 'sbadmin2';
        }

        return "plugins/".$a."/style";
    }

    public function scriptPath()
    {
        $a = getenv('app.tmp');
        if (!$a) {
            $a = 'sbadmin2';
        }

        return "plugins/".$a."/script";
    }

    public function avatar()
    {
        $a = session()->get('avatar');

        if ($a) {
            $b = $a;
        }else{
            $b = 'https://cdn.openapi2.com/img/avatar.png';
        }

        return $b;
    }

    public function appTitle()
    {
        $t = getenv('app.title');
        if (!$t) {
            $t = 'Sparkcode 4';
        }

        return $t;
    }

    public function appIco()
    {
        $t = getenv('app.favicon');

        if ($t) {
            $t = base_url($t);
        }else{
            $t = 'https://cdn.openapi2.com/img/favicon.ico';
        }

        return $t;
    }

    public function appName()
    {
        $t = getenv('app.name');

        if (!$t) {
            $t = 'Sparkcode 4';
        }

        return $t;
    }

    public function appCredit()
    {
        $a = getenv('app.credit');

        if ($a) {
            $b = '<a href="https://dorbitt.com/" target="_blank">'.$a.'</a>';
        }else{
            $b = '<a href="https://sparkcode.web.id/" target="_blank">Sparkcode 4.4.3</a>';
        }

        return $b;
        // return '<a href="https://sparkcode.web.id/" target="_blank">Sparkcode 4.4.3</a>';
    }

    public function appCopyright()
    {
        $t = getenv('app.copyright');

        if (!$t) {
            $t = 'sparkcode.web.id';
        }

        return $t;
    }

    public function appCopyrightURL()
    {
        $t = getenv('app.copyrightURL');

        if (!$t) {
            $t = 'https://sparkcode.web.id/';
        }

        return $t;
    }

    public function appText()
    {
        $text = getenv('app.text');

        if (!$text) {
            $text = 'Spark Code Version 4.4.3';
        }

        return $text;
    }

    public function appLogo()
    {
        $a = getenv('app.logo');
        $a2 = getenv('app.logo_url');

        if ($a) {
            $b = base_url($t);
        } else if ($a2) {
            $b = $a2;
        }
        else{
            $b = 'https://cdn.openapi2.com/img/logo.png';
        }

        return $b;
    }

    public function bgAuthImg()
    {
        $a = getenv('app.bgauthimg');
        if ($a) {
            $b = $a;
        }else{
            $b = 'https://cdn.openapi2.com/img/bg-auth.png';
        }

        return $b;
    }

    public function tmp()
    {
        return getenv('app.tmp');
    }
}