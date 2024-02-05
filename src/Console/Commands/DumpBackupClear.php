<?php

namespace Alexlen\Dump\Console\Commands;

use Alexlen\DumpLib\Db\BackupDump;
use Alexlen\DumpLib\Storage\StorageDump;
use Illuminate\Console\Command;

class DumpBackupClear extends Command
{
    protected $signature = 'alexlen:dump-backup-clear {--last} {--all}';

    protected $description = 'Удаление файлов бекапа';


    public function handle(BackupDump $backup)
    {
        $storage = new StorageDump();
        $files = $storage->getBackupFiles();

        if (!$files) {
            $this->info('Папка файлов бекапа пуста');
            return;
        }

        if ($this->option('all')) {
            if($this->confirm('Вы уверены, что хотите удалить все файлы бекапов?')) {
                foreach ($files as $file) {
                    $storage->delete($file);
                    $this->info("Файл бекапа $file удален");
                    sleep(1);
                }
                $this->info("Папка файлов бекапа пуста");
            }else{
                $this->info("Операция отменена");
            }
            return;
        } elseif ($this->option('last')) {
            $name = array_key_last($files);
        } else {
            $name = $this->choice('Выберите файл бекапа для удаления', array_keys($files));
        }

        $storage->delete($files[$name]);
        $this->info("Файл бекапа $files[$name] удален");
    }
}
