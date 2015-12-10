<?php

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

// import DB CONST /*{{{*/
require_once(__DIR__ . '/config/db.php');
/*}}}*/


$app = new \Slim\Slim();

// server environment and DEBUG /*{{{*/
$ips = array(
  // '10.0.2.15', // local
  '150.60.6.11'
);

if (in_array($_SERVER['SERVER_ADDR'], $ips)) {
  $app->config('debug', false);
  define('DEBUG', false);
  $_ENV['SLIM_MODE'] = 'production';
} else {
  $app->config('debug', true);
  define('DEBUG', true);
  $_ENV['SLIM_MODE'] = 'environment';
}
ini_set('display_errors', DEBUG);
/*}}}*/

// Slim Setting/*{{{*/
$app->response->headers->set(
  'Access-Control-Allow-Origin', '*'
);

$app->response->headers->set(
  'Content-Type', 'application/json;charset=utf-8'
);/*}}}*/

// Slim Extend /*{{{*/
$app->render = new Lib\Slim\Render($app);
/*}}}*/

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
