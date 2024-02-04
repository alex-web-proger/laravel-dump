<?php


namespace Alexlen\Dump\Lib\Db;


class Config
{
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
        $this->username = config('database.connections.mysql.username');
        $this->password = config('database.connections.mysql.password');
        $this->database = config('database.connections.mysql.database');
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
