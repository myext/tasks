<?php

session_start();

require ( 'functions.php' );

require_once ('vendor/autoload.php');

spl_autoload_register('_autoload_');

Config\Config::set(require_once ('config.php'));
//$cfg = new \Spot\Config();

Db\DB::setConnect([
    "host" => config("db_host"),
    "db"   => config("db_name"),
    "user" => config("db_user"),
    "pass" => config("db_pass"),
]);

define('HOME_DIR', $_SERVER['DOCUMENT_ROOT']);
define('ROOT_DIR', __DIR__);

// Sqlite
//$cfg->addConnection('sqlite', 'sqlite://path/to/database.sqlite');

// MySQL репозиторий
/*$cfg->addConnection('mysql', [
    'dbname' => $config["db"]["name"],
    'user' => $config["db"]["user"],
    'password' => $config["db"]["pass"],
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
]);*/

/*\Respect\Validation\Factory::setDefaultInstance(
    (new \Respect\Validation\Factory())
        ->withRuleNamespace('Validation\\Rules')
        ->withExceptionNamespace('Validation\\Exceptions')
);*/

/*$spot = new \Spot\Locator($cfg);

Repositories\Repository::$spot = $spot;*/

