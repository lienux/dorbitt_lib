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
        $this->is_symlink();
        $this->create_symlink();
    }

    public function is_symlink()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $upload = FCPATH . "uploads";
            if (is_link($upload) or is_dir($upload)) {
                unlink($upload);
            } elseif (is_file($upload)) {
                rmdir($upload);
            }

            $lib = FCPATH . "vendor/dorbitt-lib";
            if (is_link($lib) or is_dir($lib)) {
                rmdir($lib);
            } elseif (is_file($lib)) {
                unlink($lib);
            }

            $gAsset = FCPATH . "Gasset";
            if (is_link($gAsset)) {
                rmdir($gAsset);
            } elseif (is_file($gAsset)) {
                unlink($gAsset);
            }

            $gViews = APPPATH . "Gviews";
            if (is_link($gViews)) {
                rmdir($gViews);
            } elseif (is_file($gViews)) {
                unlink($gViews);
            }

            $myGallery = APPPATH . "Controllers/MyGallery";
            if (is_link($myGallery)) {
                rmdir($myGallery);
            } elseif (is_file($myGallery)) {
                unlink($myGallery);
            }

            $gModels = APPPATH . "Gmodels";
            if (is_link($gModels)) {
                rmdir($gModels);
            } elseif (is_file($gModels)) {
                unlink($gModels);
            }

            $gControllers = APPPATH . "Gcontrollers";
            if (is_link($gControllers)) {
                rmdir($gControllers);
            } elseif (is_file($gControllers)) {
                unlink($gControllers);
            }

            $gBuilder = APPPATH . "Gbuilder";
            if (is_link($gBuilder)) {
                rmdir($gBuilder);
            } elseif (is_file($gBuilder)) {
                unlink($gBuilder);
            }

            $gCommand = APPPATH . "Commands/Ummu";
            if (is_link($gCommand)) {
                rmdir($gCommand);
            } elseif (is_file($gCommand)) {
                unlink($gCommand);
            }


            /**
             * Create Folder*/
            $vendor = FCPATH . "vendor";
            if (!is_dir($vendor)) {
                mkdir($vendor);
            } elseif (is_file($vendor)) {
                unlink($vendor);
            }

            $ummuLogs = FCPATH . "ummuLogs";
            if (!is_link($ummuLogs)) {
                unlink($ummuLogs);
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

            if (!is_link(FCPATH . "ummuLogs")) {
                exec("rm -rf " . FCPATH . "ummuLogs");
            }
        }
    }

    public function create_symlink()
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
}