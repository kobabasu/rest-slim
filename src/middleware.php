<?php
/**
 * application middleware
 */

use \Slim\Middleware\HttpBasicAuthentication;

// e.g: $app->add(enw \Slim\Csrf\Guard);

/**
 * tuupola/slim-basic-auth
 */
$app->add(new HttpBasicAuthentication([
    'users' => [
        'api' => 'api012'
    ]
]));
