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

use Dorbitt\Curl;

class UmmuLogs
{
    public function __construct()
    {
        $this->curli = new Curl();
        $this->request  = \Config\Services::request();
    }

    public function create($text, $label = null)
    {
        $filename = date("Y-m-d") . '.html';

        if (! is_dir("/var/www/html/ummuLogs")) {
            exec("mkdir /var/www/html/ummuLogs");
        }

        exec("chmod -R 777 /var/www/html/ummuLogs");

        if (! is_file("/var/www/html/ummuLogs/" . $filename)) {
            exec("touch /var/www/html/ummuLogs/" . $filename);
        }

        exec("chmod -R 777 /var/www/html/ummuLogs");

        $fp = fopen('/var/www/html/ummuLogs/' . $filename, 'a');
        fwrite($fp, "<p>" . $label . " " . date("Y-m-d H:i:s") . "<br>" . "\n");
        fwrite($fp, json_encode($text) . "<br>" . "\n");
    }

    public function create2($filename, $text, $subject = null)
    {
        $filename = $filename. '_'. date("Y-m-d") . '.html';

        if ($subject) {
            $subject = $subject . ' | ';
        }

        if (! is_dir("/var/www/html/ummuLogs")) {
            exec("mkdir /var/www/html/ummuLogs");
        }

        exec("chmod -R 777 /var/www/html/ummuLogs");

        if (! is_file("/var/www/html/ummuLogs/" . $filename)) {
            exec("touch /var/www/html/ummuLogs/" . $filename);
        }

        exec("chmod -R 777 /var/www/html/ummuLogs");

        $fp = fopen('/var/www/html/ummuLogs/' . $filename, 'a');
        fwrite($fp, "<p>" . $subject . date("Y-m-d H:i:s") . "<br>" . "\n");
        fwrite($fp, json_encode($text) . "<br>" . "\n");
    }
}
