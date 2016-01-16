<?php
use \Pimple\Container;

require_once './bootstrap.php';

/**
 * Pimple
 */
$c = new Container();

require_once './container/configs.php';
$containerFiles = (array) glob('./container/*.php');
foreach ($containerFiles as $containerFile) {
    require $containerFile;
};

/**
 * Slim
 */
$app = $c['app'];

$routeFiles = (array) glob('./routes/*.php');
foreach ($routeFiles as $routeFile) {
    require $routeFile;
}

$app->run();
