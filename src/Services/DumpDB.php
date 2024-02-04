<?php


namespace Alexlen\Dump\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Импорт/экспорт базы данных
 */
class DumpDB
{
    protected $database;
    protected $basePath;
    /**
     * @var CredentialsDB
     */
    private $credentials;

    const DIR_NAME = 'dump';

    public function __construct()
    {
        $this->database = config('database.connections.mysql.database');
        $this->basePath = storage_path("app/" . self::DIR_NAME);
        $this->credentials = new CredentialsDB();
    }

    public function export($filename, $table = '')
    {
        $uri = $this->credentials->getUriCredentialsFiles();
        $fullName = $this->getFullFilename($filename);

        $command = "mysqldump --defaults-extra-file=\"$uri\" $this->database $table > $fullName";
        exec($command, $output, $error);

        return $error ? false : $fullName;
    }

    public function import($filename)
    {
        $uri = $this->credentials->getUriCredentialsFiles();

        $fullName = $this->getFullFilename($filename);

        $command = "mysql --defaults-extra-file=\"$uri\" $this->database < $fullName";
        exec($command, $output, $error);

        return $error ? false : $fullName;
    }

    public function backup()
    {
        $dir = self::DIR_NAME . '/backup/';
        Storage::makeDirectory($dir);
        $filename = 'backup/' . date('dmY_His') . '_' . Str::slug(config('app.name')) . '_backup.sql';
        return $this->export($filename);
    }

    protected function getFullFilename($filename)
    {
        Storage::makeDirectory(self::DIR_NAME);
        return $this->basePath . '/' . $filename;
    }

    public function existsFile($filename)
    {
        return Storage::exists(self::DIR_NAME . '/' . $filename);
    }
}
