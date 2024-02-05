<?php

namespace Alexlen\Dump\Console\Commands;

use Alexlen\DumpLib\Db\Dump;
use Alexlen\DumpLib\Storage\StorageDump;
use Illuminate\Console\Command;

class DumpRestore extends Command
{
    protected $signature = 'alexlen:dump-restore {--last}';

    protected $description = 'Импорт файлов из папки бекапов';


    public function handle(Dump $dump)
    {
        $storage = new StorageDump();
        $files = $storage->getBackupFiles();

        if (!$files) {
            $this->info('Папка файлов бекапа пуста');
            return;
        }

        if ($this->option('last')) {
            $name = array_key_last($files);
        }else{
            $name = $this->choice('Выберите файл бекапа для восстановления', array_keys($files));
        }

        $filename = $files[$name];

        if (!$this->checkConfirm($filename)) {
            return;
        }
;
        if (!$dump->import($storage->addPathBackup($filename))) {
            $this->error("Ошибка импорта бекапа");
        }else {
            $this->info("Импорт файла $filename успешно выполнен");
        }
    }

    // Уточнить серьезность намерений
    private function checkConfirm($filename)
    {
        if ($this->confirm("Вы уверены, что хотите импортировать дамп $filename в БД?")) {
            return true;
        }
        $this->info('Импорт бекапа в базу данных отменен');
    }

}
