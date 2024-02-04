<?php

namespace Alexlen\Dump\Console\Commands;

use Alexlen\Dump\Services\DumpDB;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DumpExport extends Command
{
    protected $signature = 'alexlen:dump-export {filename?} {--table=}';

    protected $description = 'Export a database dump';

    public function handle(DumpDB $dump)
    {
        $table = $this->option('table');

        if (isset($this->options()['table']) && !$table) {
            $this->error("Неверный формат. Отсутствует имя таблицы");
            return;
        }

        $filename = $this->argument('filename');
        if (!$filename && !$table) {
            $filename = Str::slug(config('app.name')) . '_db_dump.sql';
        }elseif(!$filename && $table){
            $filename = $table . '_table_dump.sql';
        }

        $this->info('Экспорт базы данных...');
        $fullName = $dump->export($filename, $table);

        if ($fullName) {
            $this->info("Дамп успешно создан {$fullName}");
        } else {
            $this->error(" Ошибка при попытке создать дамп ");
        }
    }
}
