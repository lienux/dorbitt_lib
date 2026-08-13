<?php

namespace Dorbitt\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class InstallSymlinkCommand extends BaseCommand
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
    protected $name = 'install:symlink';

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
        // ====================
        // public
        // ====================
        // Tentukan path relatif atau absolut
        $target = WRITEPATH . 'uploads'; // Path ke folder asal (writable/uploads)
        $link   = FCPATH . 'uploads';       // Path lokasi symlink (public/uploads)

        // 1. Cek apakah symlink uploads sudah ada
        if (is_link($link)) {
            // 2. Hapus symlink uploads jika sudah ada
            if (unlink($link)) {
                echo "Symlink uploads berhasil dihapus.\n";
            } else {
                echo "Gagal menghapus symlink uploads.\n";
                exit;
            }
        }

        // 3. Buat symlink uploads / link
        if (symlink($target, $link)) {
            echo "Symlink uploads berhasil dibuat!.\n";
        } else {
            echo "Gagal membuat symlink uploads.\n";
        }


        // ====================
        // create_pdf
        // ====================
        $target2 = WRITEPATH. 'create_pdf'; // Path ke folder asal (writable/uploads)
        $link2   = FCPATH . 'create_pdf';       // Path lokasi symlink (public/uploads)

        // 1. Cek apakah symlink create_pdf sudah ada
        if (is_link($link2)) {
            // 2. Hapus symlink create_pdf jika sudah ada
            if (unlink($link2)) {
                echo "Symlink create_pdf berhasil dihapus.\n";
            } else {
                echo "Gagal menghapus symlink create_pdf.\n";
                exit;
            }
        }

        // 3. Buat symlink create_pdf / link2
        if (symlink($target2, $link2)) {
            echo "Symlink create_pdf berhasil dibuat!.\n";
        } else {
            echo "Gagal membuat symlink create_pdf.\n";
        }
    }
}
