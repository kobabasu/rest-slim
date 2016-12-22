<?php
/**
 * application middleware
 */

use \Slim\Middleware\HttpBasicAuthentication;

// e.g: $app->add(enw \Slim\Csrf\Guard);

$c = $app->getContainer();

/**
 * tuupola/slim-basic-auth
 * disable as default
 */
/*
$app->add(new HttpBasicAuthentication([
    'path' => $c->get('auth')['basic_auth_path'],
    'secure' => false,
    'relaxed' => array('localhost', '127.0.0,1'),
    'users' => $c->get('auth')['basic_auth']
]));
 */
