<?php


namespace Alexlen\Dump\Lib\Db;


class Credentials
{
    private $tempFile;

    /**
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Возвращает путь к временному файлу с доступами к БД
     */
    public function getUriCredentialsFiles()
    {
        if(!$this->tempFile) {
            $this->createCredentialsFiles();
        }
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
            "user = '{$this->config->getUsername()}'",
            "password = '{$this->config->getPassword()}'",
        ];
        return implode(PHP_EOL, $contents);
    }
}
