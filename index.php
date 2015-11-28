<?php
namespace Api;

// composer /*{{{*/
require_once('vendor/autoload.php');
/*}}}*/

// server environment /*{{{*/
$ips = array(
  // '10.0.2.15', // local
  '150.60.6.11'
);

if (in_array($_SERVER['SERVER_ADDR'], $ips)) {
  $_ENV['SLIM_MODE'] = 'production';
}
/*}}}*/


$app = new \Slim\Slim();

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
