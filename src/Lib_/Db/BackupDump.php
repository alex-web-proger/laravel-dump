<?php


namespace Alexlen\Dump\Lib\Db;


use Alexlen\Dump\Lib\Helpers\FilenameHelper;
use Alexlen\Dump\Lib\Storage\StorageDump;

class BackupDump
{
    /**
     * @var Dump
     */
    private $dump;

    public function __construct(Dump $dump)
    {
        $this->dump = $dump;
    }

    public function backup($filename = false)
    {
        $storage = new StorageDump();

        $backupDir = $storage->getBackupDir();

        $filename = "$backupDir/" . FilenameHelper::backupFilename($filename);

        return $this->dump->export($filename);
    }
}
