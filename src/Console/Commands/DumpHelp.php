<?php

namespace Alexlen\Dump\Console\Commands;

use Illuminate\Console\Command;

class DumpHelp extends Command
{
    protected $signature = 'alexlen:dump-help';

    protected $description = 'Помощь по пакету';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Пакет предназначен для экспорта/импорта содеримого БД или экспорта отдельной таблицы');
        $this->info('Каталог расположения дампа: storage/app/dump');
        $this->info('Перед импортом автоматически создается бекап в каталоге storage/app/dump/backup');
        $this->info('Чтобы при ипортировании избежать создания бекапа, нужно указать ключ --no-backup');
        $this->info('Примеры использования для экспорта/импорта:');
        $this->table(['Команда', 'Действие'], [
            ['php artisan alexlen:dump-help', 'Отобразить описание пакета'],
            ['php artisan alexlen:dump-export', 'Создать дамп БД с дефолтным именем файла'],
            ['php artisan alexlen:dump-export my_dump.sql', 'Создать дамп БД с именем my_dump.sql'],
            ['php artisan alexlen:dump-export --table=users', 'Создать дамп таблицы users'],
            ['php artisan alexlen:dump-import my_dump.sql', 'Импортировать дамп в БД'],
        ]);
        $this->info('Примеры работы с бекапом:');
        $this->table(['Команда', 'Действие'], [
            ['php artisan alexlen:dump-backup', 'Создать бекап с дефолтным именем файла'],
            ['php artisan alexlen:dump-backup my_backup', 'Создать бекап с именем файла my_backup  '],
            ['php artisan alexlen:dump-backup --list', 'Список файлов бекапа'],
            ['php artisan alexlen:dump-backup-clear', 'Выбор файла бекапа для удаления'],
            ['php artisan alexlen:dump-backup-clear --last ', 'Удалить последний файл бекапа'],
            ['php artisan alexlen:dump-backup-clear --all', 'Очистить папку с файлами бекапа'],
        ]);
        $this->info('Импорт из бекапа:');
        $this->table(['Команда', 'Действие'], [
            ['php artisan alexlen:dump-restore', 'Выбор файла бекапа и его импорт'],
            ['php artisan alexlen:dump-restore --last      ', 'Импорт последнего файла бекапа          '],
        ]);
    }
}
