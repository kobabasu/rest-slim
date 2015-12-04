<?php
ini_set('display_errors', 1);
const DB_HOST = '0.0.0.0';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root012';
const DB_NAME = 'api';

// composer /*{{{*/
require_once(__DIR__ . '/vendor/autoload.php');
/*}}}*/

// lib /*{{{*/
require_once(__DIR__ . '/SplClassLoader.php');
$loader = new \SplClassLoader('Lib', __DIR__ );
$loader->register();
// import lib demonstration
// should be displayed 'Lib\Hello\Hello'
// $Hello = new Lib\Hello\Hello();
/*}}}*/

// server environment /*{{{*/
$ips = array(
  // '10.0.2.15', // local
  '150.60.6.11'
);

if (in_array($_SERVER['SERVER_ADDR'], $ips)) {
  ini_set('display_errors', 0);
  $_ENV['SLIM_MODE'] = 'production';
}
/*}}}*/


$app = new \Slim\Slim();

// production settings /*{{{*/
$app->configureMode('production', function() use ($app) {
  $app->config(array(
    'msg' => 'production mode',
    'log.enable' => true,
    'debug' => false
  ));
});
/*}}}*/

// development settings /*{{{*/
$app->configureMode('development', function() use ($app) {
  $app->config(array(
    'msg' => 'development mode',
    'log.enable' => false,
    'debug' => true
  ));
});
/*}}}*/

// routes /*{{{*/
$routeFiles = (array) glob('routes/*.php');
foreach ($routeFiles as $routeFile) {
  require $routeFile;
}
/*}}}*/

$app->run();


/*
vim:ma:et:nu:ff=unix:fenc=utf-8:ft=php:ts=2:sts=0:sw=2:tw=60:fdm=marker:
 */
