<?php

$config = require_once("boot.php");

$pdo = new \PDO(
    "mysql:host=".config('db_host').";dbname=".config('db_name'),
    config('db_user'),
    config('db_pass'),
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

$query_tasks = "
CREATE TABLE IF NOT EXISTS tasks(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `text` TEXT NOT NULL,
  `is_done` INT(1) NOT NULL default '0',
  `is_censored` INT(1) NOT NULL default '0' ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$pdo->exec($query_tasks);

$query = "INSERT INTO tasks ( `name`, `text`, `email` ) VALUES('Test_name', 'Test task', 'qqqq@yandex.ru')";
$pdo->exec($query);




