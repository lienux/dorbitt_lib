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

    public function run()
    {
        $this->mk_dir();
        $this->rm_dir();
        $this->sym_link();
    }

    public function rm_dir()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $array = [
                FCPATH . "uploads",
                FCPATH . "vendor/dorbitt-lib",
                FCPATH . "Gasset",
                FCPATH . "ummuLogs",
                APPPATH . "Gviews",
                APPPATH . "Controllers/MyGallery",
                APPPATH . "Gmodels",
                APPPATH . "Gcontrollers",
                APPPATH . "Gbuilder",
                APPPATH . "Commands/Ummu"
            ];

            foreach ($array as $key => $value) {
                if (file_exists($value)) {
                    if (is_link($value) or is_dir($value)) {
                        // unlink($file);
                        rmdir($value);
                    }
                }
            }
        } else {
            if (is_link(FCPATH . "uploads")) {
                exec("rm -rf " . FCPATH . "uploads");
            }

            if (is_link(FCPATH . "vendor/dorbitt-lib")) {
                exec("rm -rf " . FCPATH . "vendor/dorbitt-lib");
            }

            if (is_link(FCPATH . "Gasset")) {
                exec("rm -rf " . FCPATH . "Gasset");
            }

            if (is_link(APPPATH . "Gviews")) {
                exec("rm -rf " . APPPATH . "Gviews");
            }

            if (is_link(APPPATH . "Controllers/MyGallery")) {
                exec("rm -rf " . APPPATH . "Controllers/MyGallery");
            }

            if (is_link(APPPATH . "Gmodels")) {
                exec("rm -rf " . APPPATH . "Gmodels");
            }

            if (is_link(APPPATH . "Gcontrollers")) {
                exec("rm -rf " . APPPATH . "Gcontrollers");
            }

            if (is_link(APPPATH . "Gbuilder")) {
                exec("rm -rf " . APPPATH . "Gbuilder");
            }

            if (is_link(APPPATH . "Commands/Ummu")) {
                exec("rm -rf " . APPPATH . "Commands/Ummu");
            }


            /**
             * Create Folder*/
            if (!is_dir(FCPATH . "vendor")) {
                exec("mkdir " . FCPATH . "vendor");
            }

            if (is_link(FCPATH . "ummuLogs")) {
                exec("rm -rf " . FCPATH . "ummuLogs");
            }
        }
    }

    public function sym_link()
    {
        $uploads = [WRITEPATH . "uploads", FCPATH . "uploads"];
        $assetlib = [ROOTPATH . "vendor/dorbitt/lib/src/Gasset", FCPATH . "vendor/dorbitt-lib"];
        $gAsset = [ROOTPATH . "vendor/dorbitt/lib/src/Gasset", FCPATH . "Gasset"];
        $gViews = [ROOTPATH . "vendor/dorbitt/lib/src/Gviews", APPPATH . "Gviews"];
        $myGallery = [ROOTPATH . "vendor/dorbitt/lib/src/Controllers/MyGallery", APPPATH . "Controllers/MyGallery"];
        $gModels = [ROOTPATH . "vendor/dorbitt/lib/src/Gmodels", APPPATH . "Gmodels"];
        $gControllers = [ROOTPATH . "vendor/dorbitt/lib/src/Gcontrollers", APPPATH . "Gcontrollers"];
        $gBuilder = [ROOTPATH . "vendor/dorbitt/lib/src/Gbuilder", APPPATH . "Gbuilder"];
        $gCommand = [ROOTPATH . "vendor/dorbitt/lib/src/Commands/Ummu", APPPATH . "Commands/Ummu"];
        $ummuLogs = [WRITEPATH . "ummuLogs", FCPATH . "ummuLogs"];

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            symlink($uploads[0], $uploads[1]);
            symlink($assetlib[0], $assetlib[1]);
            symlink($gAsset[0], $gAsset[1]);
            symlink($gViews[0], $gViews[1]);
            symlink($myGallery[0], $myGallery[1]);
            symlink($gModels[0], $gModels[1]);
            symlink($gControllers[0], $gControllers[1]);
            symlink($gBuilder[0], $gBuilder[1]);
            symlink($gCommand[0], $gCommand[1]);
            symlink($ummuLogs[0], $ummuLogs[1]);
        } else {
            exec("ln -s " . $uploads[0] . " " . $uploads[1]);
            exec("ln -s " . $assetlib[0] . " " . $assetlib[1]);
            exec("ln -s " . $gAsset[0] . " " . $gAsset[1]);
            exec("ln -s " . $gViews[0] . " " . $gViews[1]);
            exec("ln -s " . $myGallery[0] . " " . $myGallery[1]);
            exec("ln -s " . $gModels[0] . " " . $gModels[1]);
            exec("ln -s " . $gControllers[0] . " " . $gControllers[1]);
            exec("ln -s " . $gBuilder[0] . " " . $gBuilder[1]);
            exec("ln -s " . $gCommand[0] . " " . $gCommand[1]);
            exec("ln -s " . $ummuLogs[0] . " " . $ummuLogs[1]);
        }
    }

    private function mk_dir()
    {
        $vendor = FCPATH . "vendor";
        if (!is_dir($vendor)) {
            mkdir($vendor);
            // unlink($vendor);
        }

        $ummuLogs = WRITEPATH . "ummuLogs";
        if (!is_dir($ummuLogs)) {
            mkdir($ummuLogs);
        }
    }
}