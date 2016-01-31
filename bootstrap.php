<?php
use \Slim\App;

/**
 * Slim
 */
$settings = require __DIR__ . '/src/settings.php';
$app = new App($settings);

require __DIR__ . '/src/dependencies.php';

require __DIR__ . '/src/middleware.php';

require __DIR__ . '/src/app.php';

$routeFiles = (array) glob('./routes/*.php');
foreach ($routeFiles as $routeFile) {
    require $routeFile;
}

$app->run();
