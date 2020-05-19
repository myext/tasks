<?php

function _autoload_($classname) {
    $path = str_replace("\\", "/", 'Src/'.$classname).".php";
    include_once($path);
}

function config(string $param)
{
    $env = Config\Config::get();

    if(!array_key_exists($param, $env)) return false;

    return $env[$param];
};

function view($params = [], $status = 200, $view = 'default')
{
    View\View::flush($params, $status, $view);
}
