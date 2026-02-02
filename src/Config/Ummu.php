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
use Dorbitt\Helpers\EncrypterHelper;

class Ummu extends BaseConfig
{
    public function __construct()
    {
        $this->vHelp = new ViewsHelper();
        $this->gVhelp = new GviewsHelper();
        $this->encryptH = new EncrypterHelper();
    }

    public function ViHe(string $methodName = null)
    {
        if (method_exists($this->vHelp, $methodName)) {
            return $this->vHelp->$methodName();
        }
        
        return null;
    }

    public function gViHe(string $methodName = null)
    {
        if (method_exists($this->gVhelp, $methodName)) {
            return $this->gVhelp->$methodName();
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
}