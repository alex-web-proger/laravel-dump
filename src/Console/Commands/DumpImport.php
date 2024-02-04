<?php

namespace Alexlen\Dump\Console\Commands;

use Alexlen\Dump\Services\DumpDB;
use Illuminate\Console\Command;

class DumpImport extends Command
{
    protected $signature = 'alexlen:dump-import {filename} {--no-backup}';

    protected $description = 'Import a database dump';

    public function handle(DumpDB $dump)
    {
        $filename = $this->argument('filename');

        // Убедиться в существовании файла дампа БД
        if (!$dump->existsFile($filename)) {
            $this->error("Файл $filename не найден!");
            return;
        }

        if (!$this->confirm("Вы уверены, что хотите импортировать дамп $filename в БД?")) {
            $this->info('Импорт дампа в базу данных отменен');
            return;
        }

        // Создать бекап
        $noBackup = $this->option('no-backup');
        if (!$noBackup || !$this->confirm('Вы уверены, что не хотите делать бекап?')) {
            $this->info('Создание бекапа...');
            if (!$dump->backup()) {
                $this->error("Ошибка при создании бекапа");
                return;
            }
            $this->info('Бекап успешно создан');
        }

        // Импортировать дамп
        $this->info('Импорт дампа в базу данных...');
        if (!$dump->import($filename)) {
            $this->error("Ошибка импорта дампа");
            return;
        }
        $this->info('Импорт успешно выполнен');
    }
}
