<?php

namespace Dorbitt;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

class UmmuInstall
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    public function run($mode)
    {
        $this->link($mode);
        $this->mygallery($mode);
    }

    public function link($mode)
    {
        if ($mode == 'dev') {
            exec("ln -s ".WRITEPATH."uploads"." ".FCPATH);
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gasset"." ".FCPATH."vendor/dorbitt-lib");
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gasset"." ".FCPATH."Gasset");
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gviews"." ".APPPATH."Gviews");
        }else{
            exec("ln -s ".WRITEPATH."uploads"." ".FCPATH);
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gasset"." ".FCPATH."vendor/dorbitt-lib");
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gasset"." ".FCPATH."Gasset");
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gviews"." ".APPPATH."Gviews");
        }
    }

    public function mygallery($mode)
    {
        if (is_link(APPPATH."Controllers/MyGallery")) {
            exec("rm -rf ".APPPATH."Controllers/MyGallery");
        }

        if ($mode == 'dev') {
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Controllers/MyGallery"." ".APPPATH."Controllers/MyGallery");
        }else{
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Controllers/MyGallery"." ".APPPATH."Controllers/MyGallery");
        }
    }


    // =====================================================
    // =====================================================
    // =====================================================
    public function run2()
    {
        $this->is_symlink();
        $this->create_symlink();
    }

    public function is_symlink()
    {
        if (is_link(FCPATH."uploads")) {
            exec("rm -rf ".FCPATH."uploads");
        }

        if (is_link(FCPATH."vendor/dorbitt-lib")) {
            exec("rm -rf ".FCPATH."vendor/dorbitt-lib");
        }

        if (is_link(FCPATH."Gasset")) {
            exec("rm -rf ".FCPATH."Gasset");
        }

        if (is_link(APPPATH."Gviews")) {
            exec("rm -rf ".APPPATH."Gviews");
        }

        if (!is_dir(FCPATH."vendor")) {
            exec("mkdir ". FCPATH ."vendor");
        }
    }

    public function create_symlink()
    {
        if (ENVIRONMENT === 'development') {
            exec("ln -s ".WRITEPATH."uploads"." ".FCPATH);
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gasset"." ".FCPATH."vendor/dorbitt-lib");
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gasset"." ".FCPATH."Gasset");
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gviews"." ".APPPATH."Gviews");
        }else{
            exec("ln -s ".WRITEPATH."uploads"." ".FCPATH);
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gasset"." ".FCPATH."vendor/dorbitt-lib");
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gasset"." ".FCPATH."Gasset");
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gviews"." ".APPPATH."Gviews");
        }

        $this->mygallery_symlink();
    }

    public function mygallery_symlink()
    {
        if (is_link(APPPATH."Controllers/MyGallery")) {
            exec("rm -rf ".APPPATH."Controllers/MyGallery");
        }

        if (ENVIRONMENT === 'development') {
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Controllers/MyGallery"." ".APPPATH."Controllers/MyGallery");
        }else{
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Controllers/MyGallery"." ".APPPATH."Controllers/MyGallery");
        }
    }
}
