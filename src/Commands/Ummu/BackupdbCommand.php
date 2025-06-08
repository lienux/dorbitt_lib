<?php

namespace App\Commands\Ummu;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class BackupdbCommand extends BaseCommand
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
    protected $name = 'ummu:backupdb';

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
        exec("mysqldump -u root -p'DorbitT344!?' --opt --all-databases | gzip > /backupDB/".date('Y-m')."/".date('Y-m-d')."/alldb.sql.gz");
    }

}
