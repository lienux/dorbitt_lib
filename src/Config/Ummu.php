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
use Dorbitt\Helpers\GviewsHelper;
use Dorbitt\Helpers\DateTimeHelper;
use Dorbitt\Helpers\EncrypterHelper;
use Dorbitt\Helpers\JwtHelper;

class Ummu extends BaseConfig
{
    public function __construct()
    {
        $this->vHelp = new ViewsHelper();
        $this->gVhelp = new GviewsHelper();
        $this->dtHelp = new DateTimeHelper();
        $this->encryptH = new EncrypterHelper();
        $this->jwtH = new JwtHelper();
    }

    public function ViHe(string $methodName = null, string $filename = null)
    {
        if (method_exists($this->vHelp, $methodName)) {
            return $this->vHelp->$methodName($filename);
        }
        
        return null;
    }

    public function gViHe(string $methodName = null, string $filename = null)
    {
        if (method_exists($this->gVhelp, $methodName)) {
            return $this->gVhelp->$methodName($filename);
        }
        
        return null;
    }

    public function dtHe(string $methodName = null, string $payload = null)
    {
        if (method_exists($this->dtHelp, $methodName)) {
            return $this->dtHelp->$methodName($payload);
        }
        
        return null;
    }

    public function EncrHe(string $methodName = null)
    {
        if (method_exists($this->encryptH, $methodName)) {
            return $this->encryptH->$methodName();
        }
        
        return null;
    }

    public function jwtH(string $methodName = null, $data)
    {
        if (method_exists($this->jwtH, $methodName)) {
            return $this->jwtH->$methodName($data);
        }
        
        return null;
    }

    public function include_partial(string $filename)
    {
        return '../../vendor/dorbitt/lib/src/Views/partials/'.$filename.'.php';
    }

    public function pages(string $filename)
    {
        return '../../vendor/dorbitt/lib/src/Views/pages/'.$filename.'.php';
    }

    public function Views(string $filename)
    {
        return '../../vendor/dorbitt/lib/src/Views/'.$filename.'.php';
    }

    public function script($filename)
    {
        if (getenv('CI_DORBITT') == 'development') {
            return "http://localhost/dorbitt/dorbitt_lib/src/Script/" . $filename . ".js?time=" . date('YmdHis');
        }else{
            return "https://cdn.openapi2.com/Script/" . $filename . ".js?time=" . date('YmdHis');
        }
    }
}