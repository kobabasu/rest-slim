<?php
use Lib\Config\DetectEnvironment;

/**
 * Composer
 */
require_once(__DIR__ . '/vendor/autoload.php');

/**
 * server environment
 */
$file = __DIR__ .'/config/ips';
$ext = (is_file($file . '.php')) ? '.php' : '.php.sample';
$production_server_ips = require($file . $ext);

$env = new DetectEnvironment($production_server_ips);
// $env->setMode('proxies');
$file = __DIR__ . '/config/' . $env->getName();
$ext = (is_file($file . '.php')) ? '.php' : '.php.sample';
require($file . $ext);

/**
 * detect debug mode
 */
const DEBUG = DEBUG_DEFAULT;
//const DEBUG = true;
ini_set('display_errors', DEBUG);

/**
 * bootstrap
 */
require_once './bootstrap.php';
