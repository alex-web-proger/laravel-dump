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

Отобразить описание пакета
```sh
  php artisan alexlen:dump-help
```
Создать дамп БД. Имя файла создается автоматически
```sh
  php artisan alexlen:dump-export
```
Создать дамп БД с именем my_dump.sql
```sh
  php artisan alexlen:dump-export my_dump.sql
```
 Создать дамп таблицы users
```sh
  php artisan alexlen:dump-export --table=users
```
Импортировать дамп в БД
```sh
  php artisan alexlen:dump-import my_dump.sql
```
