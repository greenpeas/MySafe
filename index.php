<?php

$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + round($mtime[0], 3);
define("TSTART", $mtime);
session_start();

// Подключаем все классы

spl_autoload_register(function ($class) {
    require_once('protected/class/' . $class . '.php');
});

/*
$files = scandir('protected/class');
foreach ($files AS $file)
    if ($file != '.' AND $file != '..')
        require_once('protected/class/' . $file);
*/
require_once('protected/controller.php');

$controller = new controller;

// если юзер не гость и не имеет ключа
$controller->haskey();

// url manager
// получаем имя метода из URL и заносим его в $matches
preg_match_all('/\/(.*?)(\.|$|\?)/i', $_SERVER['REQUEST_URI'], $matches);

// если главная страницая, то $matches[1][0] пуст. Подключаем Index экшн.
// Иначе проверяем существование метода по имени из URL и при нахождении подключаем.

$matches[1][0] = str_replace('-', '', $matches[1][0]);

//die('<pre>'.print_r($matches,1).'</pre>');

if (!$matches[1][0])
    $html = $controller->index();
elseif (method_exists($controller, $matches[1][0]))
    $html = $controller->$matches[1][0]();
else
    $html = $controller->notfound();

