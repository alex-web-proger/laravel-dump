<?php


namespace Alexlen\Dump\Lib\Storage;

use Illuminate\Support\Facades\Storage;

class StorageDump
{
    const STORAGE_DIR_NAME = 'dump';
    const STORAGE_BACKUP_DIR_NAME = 'backup';

    public function __construct()
    {
        Storage::makeDirectory(self::STORAGE_DIR_NAME);
    }

    /**
     * Имя файла с полным путем к нему на диске
     */
    public function getFullFilename($filename)
    {
        return storage_path("app/" . self::STORAGE_DIR_NAME) . '/' . $filename;
    }

    public function existsFile($filename)
    {
        return Storage::exists(self::STORAGE_DIR_NAME . '/' . $filename);
    }

    public function getBackupDir()
    {
        $dir = self::STORAGE_DIR_NAME . "/" . self::STORAGE_BACKUP_DIR_NAME . "/";
        Storage::makeDirectory($dir);
        return self::STORAGE_BACKUP_DIR_NAME;
    }
}
