<?php

namespace App\Commands\Ummu;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class DorbittlibCopyCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'CodeIgniter';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'ummu:dorbittlib-copy';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'command:name [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        if (ENVIRONMENT == 'development') {
            if (!is_dir(ROOTPATH . "vendor/dorbitt")) {
                exec("sudo mkdir " . ROOTPATH . "vendor/dorbitt");
            }

            if (is_dir(ROOTPATH . "vendor/dorbitt/lib")) {
                exec("sudo rm -rf " . ROOTPATH . "vendor/dorbitt/lib");
            }

            exec("sudo ln -s /var/www/html/dorbitt/dorbitt_lib " . ROOTPATH . "vendor/dorbitt/lib");
        }
    }

}
