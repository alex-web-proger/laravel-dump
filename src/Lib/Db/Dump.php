<?php


namespace Alexlen\Dump\Lib\Db;

use Alexlen\Dump\Lib\Storage\StorageDump;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Импорт/экспорт базы данных
 */
class Dump
{
    private $database;

    /**
     * @var Credentials
     */
    private $credentials;


    public function __construct()
    {
        $config = new Config();
        $this->credentials = new Credentials($config);
        $this->database = $config->getDatabase();
    }

    public function export($filename, $table = '')
    {
        $uri = $this->credentialsFiles();
        $fullName = $this->fullFilename($filename);
        $command = "mysqldump --defaults-extra-file=\"$uri\" $this->database $table > $fullName";
        exec($command, $output, $error);
        return $error ? false : $fullName;
    }

    public function import($filename)
    {
        $uri = $this->credentialsFiles();
        $fullName = $this->fullFilename($filename);
        $command = "mysql --defaults-extra-file=\"$uri\" $this->database < $fullName";
        exec($command, $output, $error);
        return $error ? false : $fullName;
    }

    private function credentialsFiles()
    {
        return $this->credentials->getUriCredentialsFiles();
    }

    private function fullFilename($filename)
    {
        $storage = new StorageDump();
        return $storage->getFullFilename($filename);
    }

}
