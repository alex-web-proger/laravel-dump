<?php

namespace Alexlen\Dump\Console\Commands;

use Alexlen\DumpLib\Db\BackupDump;
use Alexlen\DumpLib\Storage\StorageDump;
use Illuminate\Console\Command;

class DumpBackup extends Command
{
    protected $signature = 'alexlen:dump-backup {filename?} {--list}';

    protected $description = 'Создание бекапа';


    public function handle(BackupDump $backup)
    {

        if ($this->option('list')) {
            $this->list();
            return;
        }

        $this->info('Создание бекапа...');
        $filename = $this->argument('filename');

        if (!$backup->backup($filename)) {
            $this->error("Ошибка при создании бекапа");
            return;
        }

        $this->info('Бекап успешно создан');
    }

    private function list()
    {
        $storage = new StorageDump();
        $files = $storage->getBackupFiles();

        if (!$files) {
            $this->info('Папка файлов бекапа пуста');
            return;
        }

        $this->info("Список файлов бекапа:");
        foreach ($files as $name => $file) {
            $this->info($name);
        }
    }
}
