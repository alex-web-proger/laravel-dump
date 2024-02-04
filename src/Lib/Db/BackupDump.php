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

    public function backup()
    {
        $storage = new StorageDump();

        $backupDir = $storage->getBackupDir();

        $filename = "$backupDir/" . FilenameHelper::backupFilename();

        return $this->dump->export($filename);
    }
}
