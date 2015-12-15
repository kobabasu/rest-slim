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

function createContainer() {
  $container = new \Pimple\Container();

  $app = new \Slim\Slim();

  // Slim Setting/*{{{*/
  $app->response->headers->set(
    'Access-Control-Allow-Origin', '*'
  );

  $app->response->headers->set(
    'Content-Type', 'application/json;charset=utf-8'
  );
  /*}}}*/

  // Slim Extend /*{{{*/
  $app->Render = new Lib\Slim\Render($app);
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

  $container['app'] = $app;

  return $container;
}


/*
vim:ma:et:nu:ff=unix:fenc=utf-8:ft=php:ts=2:sts=0:sw=2:tw=60:fdm=marker:
 */
