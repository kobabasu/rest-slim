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
$c = createContainer();
$app = $c['app'];

$c['hello'] = function($c) {
  $hello = new Lib\Hello\Hello('konan');
  return $hello;
};

$c['service'] = function($c) {
  $service = new Lib\Sample\Service;
  return $service;
};

$c['client'] = function($c) {
  $client = new Lib\Sample\Client($c['service']);
  return $client;
};

$client = $c['client'];
$client->say('nyanyanya koko');

// import DB CONST /*{{{*/
require_once(__DIR__ . '/config/db.php');
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
