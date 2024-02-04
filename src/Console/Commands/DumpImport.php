<?php

namespace Alexlen\Dump\Console\Commands;

use Alexlen\Dump\Lib\Db\BackupDump;
use Alexlen\Dump\Lib\Db\Dump;
use Alexlen\Dump\Lib\Storage\StorageDump;
use Illuminate\Console\Command;

class DumpImport extends Command
{
    protected $signature = 'alexlen:dump-import {filename} {--no-backup}';

    protected $description = 'Import a database dump';


    public function handle(Dump $dump)
    {
        $filename = $this->argument('filename');

        if (!$this->checkExistsFile($filename)) {
            return;
        }

        if (!$this->checkConfirm($filename)) {
            return;
        }

        if(!$this->backup($dump)){
           return;
        }

        $this->info('Импорт дампа в базу данных...');

        if (!$dump->import($filename)) {
            $this->error("Ошибка импорта дампа");
        }else {
            $this->info('Импорт успешно выполнен');
        }
    }


    // Проверка существования файла дампа БД
    private function checkExistsFile($filename)
    {
        $storage = new StorageDump();
        if ($storage->existsFile($filename)) {
            return true;
        }
        $this->error("Файл $filename не найден!");
    }


    // Уточнить серьезность намерений
    private function checkConfirm($filename)
    {
        if ($this->confirm("Вы уверены, что хотите импортировать дамп $filename в БД?")) {
            return true;
        }
        $this->info('Импорт дампа в базу данных отменен');
    }


    // Бекап
    private function backup(Dump $dump)
    {
        $noBackup = $this->option('no-backup');

        if (!$noBackup || !$this->confirm('Вы уверены, что не хотите делать бекап?')) {

            $this->info('Создание бекапа...');

            $backup = new BackupDump($dump);

            if (!$backup->backup()) {
                $this->error("Ошибка при создании бекапа");
                return;
            }
            $this->info('Бекап успешно создан');

        }
        return true;
    }
}
