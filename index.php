<?php
// server environment and DEBUG /*{{{*/
$ips = array(
  // '10.0.2.15', // local
  '150.60.6.11'
);

if (in_array($_SERVER['SERVER_ADDR'], $ips)) {
  define('DEBUG', false);
  $_ENV['SLIM_MODE'] = 'production';
} else {
  define('DEBUG', true);
  $_ENV['SLIM_MODE'] = 'development';
}
ini_set('display_errors', DEBUG);
/*}}}*/

require './bootstrap.php';
$container = createContainer();
$app = $container['app'];

// import DB CONST /*{{{*/
require_once(__DIR__ . '/config/db.php');
/*}}}*/

// production settings /*{{{*/
$app->configureMode('production', function() use ($app) {
  $app->config(array(
    'msg' => 'production mode',
    'log.enable' => true,
    'debug' => false,
    'smtp' => array(
      'host' => '127.0.0.1',
      'port' => 1025,
      'user' => null,
      'pass' => null
    )
  ));
});
/*}}}*/

// development settings /*{{{*/
$app->configureMode('development', function() use ($app) {
  $app->config(array(
    'msg' => 'development mode',
    'log.enable' => false,
    'debug' => true,

    'smtp' => array(
      'host' => '127.0.0.1',
      'port' => 1025,
      'user' => null,
      'pass' => null
    )
  ));
});
/*}}}*/

// SwiftMailer /*{{{*/
$app->config(array(
  'mail' => array(
    'subject' => 'default subject',
    'from'    => 'admin@example.com',
    'body'    => 'default body'
  )
));
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
