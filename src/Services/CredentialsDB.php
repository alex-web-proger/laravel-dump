<?php


namespace Alexlen\Dump\Services;


class CredentialsDB
{
    private $tempFile;
    private $username;
    private $password;

    public function __construct()
    {
        $this->username = config('database.connections.mysql.username');
        $this->password = config('database.connections.mysql.password');
    }

    /**
     * Возвращает путь к временному файлу с доступами к БД
     */
    public function getUriCredentialsFiles()
    {
        $this->createCredentialsFiles();
        return stream_get_meta_data($this->tempFile)['uri'];
    }

    /**
     * Создать временный файл с доступами к БД
     */
    private function createCredentialsFiles()
    {
        $this->tempFile = tmpfile();
        fwrite($this->tempFile, $this->getContents());
    }

    /**
     * Содержимое временного файла
     */
    protected function getContents()
    {
        $contents = [
            '[client]',
            "user = '{$this->username}'",
            "password = '{$this->password}'",
        ];
        return implode(PHP_EOL, $contents);
    }
}
