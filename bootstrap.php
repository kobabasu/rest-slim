<?php
use \Slim\App;

/**
 * Slim
 */
// import ./src/settings.php first
$settings = require __DIR__ . '/src/settings.php';
$app = new App($settings);

// require ./src
require __DIR__ . '/src/dependencies.php';
require __DIR__ . '/src/middleware.php';
require __DIR__ . '/src/app.php';

// require ../slimphp/routes
$routeFiles = (array) glob(CONTENT_DIR_PATH . '/routes/*.php');
foreach ($routeFiles as $routeFile) {
    require $routeFile;
}

// then run
$app->run();
