## Импорт/экспорт БД с помощью artisan-команд
Пакет позволяет выполнять экспорт/импорт содержимого базы данных и экспорт
отдельных таблиц посредством artisan-команд
### Установка

```sh
 composer require alexlen/laravel-dump
```

### Использование
Каталог расположения дампа: storage/app/dump

Перед импортом автоматически создается бекап в каталоге storage/app/dump/backup

Чтобы при ипортировании избежать создания бекапа, нужно указать ключ --no-backup

### Примеры

<table>
    <thead>
        <tr>
            <th>Команда</th>
            <th>Описание</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>php artisan alexlen:dump-help</td>
            <td>Отобразить описание пакета</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-export</td>
             <td>Создать дамп БД с дефолтным именем файла</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-export my_dump.sql</td>
             <td>Создать дамп БД с именем my_dump.sql</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-export --table=users</td>
             <td>Создать дамп таблицы users</td>
        </tr>
        <tr>
             <td> php artisan alexlen:dump-import my_dump.sql</td>
             <td>Импортировать дамп в БД</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-backup</td>
             <td>Создать бекап с дефолтным именем файла</td>
        </tr>
        <tr>
             <td> php artisan alexlen:dump-backup my_backup</td>
             <td>Создать бекап с именем файла my_backup</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-backup --list</td>
             <td> Список файлов бекапа</td>
        </tr>   
        <tr>
             <td>php artisan alexlen:dump-backup-clear</td>
             <td>Выбор файла бекапа для удаления</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-backup-clear --last</td>
             <td>Удалить последний файл бекапа</td>
        </tr>
        <tr>
             <td> php artisan alexlen:dump-backup-clear --all</td>
             <td>  Очистить папку с файлами бекапа</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-restore</td>
             <td> Выбор файла бекапа и его импорт</td>
        </tr>
        <tr>
             <td>php artisan alexlen:dump-restore --last</td>
             <td>Импорт последнего файла бекапа</td>
        </tr>                                                                                     
    </tbody>
</table>
