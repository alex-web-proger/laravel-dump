<?php

namespace Alexlen\Dump\Console\Commands;

use Illuminate\Console\Command;

class DumpHelp extends Command
{
    protected $signature = 'alexlen:dump-help';

    protected $description = 'Package description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Пакет предназначен для экспорта/импорта содеримого БД или экспорта отдельной таблицы');
        $this->info('Каталог расположения дампа: storage/app/dump');
        $this->info('Перед импортом автоматически создается бекап в каталоге storage/app/dump/backup');
        $this->info('Чтобы при ипортировании избежать создания бекапа, нужно указать ключ --no-backup');
        $this->info('Примеры использования:');
        $this->table(['Команда', 'Действие'], [
            ['php artisan alexlen:dump-help', 'Отобразить описание пакета'],
            ['php artisan alexlen:dump-export', 'Создать дамп БД. Имя файла создается автоматически'],
            ['php artisan alexlen:dump-export my_dump.sql', 'Создать дамп БД с именем my_dump.sql'],
            ['php artisan alexlen:dump-export --table=users', 'Создать дамп таблицы users'],
            ['php artisan alexlen:dump-import my_dump.sql', 'Импортировать дамп в БД'],
        ]);
    }
}
