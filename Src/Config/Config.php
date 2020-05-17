<?php


namespace Config;


class Config
{
    protected static $conf = [];

    public static function set(array $cnf)
    {
        self::$conf = $cnf;
    }

    public static function get()
    {
        return self::$conf;
    }

}