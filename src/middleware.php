<?php
/**
 * application middleware
 */

use \Slim\Middleware\HttpBasicAuthentication;

// e.g: $app->add(enw \Slim\Csrf\Guard);

$c = $app->getContainer();

/**
 * tuupola/slim-basic-auth
 */
$app->add(new HttpBasicAuthentication([
    'users' => $c->get('settings')['basic_auth']
]));
