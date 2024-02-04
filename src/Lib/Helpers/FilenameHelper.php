<?php


namespace Alexlen\Dump\Lib\Helpers;


use Illuminate\Support\Str;

class FilenameHelper
{

    public static function backupFilename($name = false, $separator = '_')
    {
        $params = [
            'prefix' => date("dmY{$separator}His"),
            'name' => $name ?: Str::slug(config('app.name')),
            'suffix' => 'backup.sql'
        ];
        return implode($separator, $params);
    }
}
