<?php

//FRONT CONTROLLER

//общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

//подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');


//установка соединения с БД



//вызов Router
$r = new Router;
$r->run();