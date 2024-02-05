<?php


namespace Alexlen\Dump\Lib\Helpers;


use Illuminate\Support\Str;

class FilenameHelper
{
    public static function backupFilename($name = false, $separator = '_')
    {
        if ($name) {
            $name = str_replace('.sql', '', $name);
            $name = str_replace('.', '', $name);
        }else{
            $name = Str::slug(config('app.name'));
        }

        $params = [
            'prefix' => date("dmY{$separator}His"),
            'name' => $name,
            'suffix' => 'backup.sql'
        ];
        return implode($separator, $params);
    }
}
