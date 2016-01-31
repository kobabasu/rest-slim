<?php
$withJsonEncOption = (DEBUG) ? JSON_UNESCAPED_UNICODE : 0 ;

return array(
    'withJsonEncOption' => $withJsonEncOption,

    'settings' => array(
        'environment' => ENVIRONMENT_MODE,
        'displayErrorDetails' => DEBUG
    ),

    'db' => array(
        'host' => DB_HOST,
        'name' => DB_NAME,
        'user' => DB_USER,
        'pass' => DB_PASS,
        'port' => DB_PORT,
        'charset' => DB_CHARSET
    ),

    'mail' => array(
        'host' => MAIL_HOST,
        'port' => MAIL_PORT,
        'user' => MAIL_USER,
        'pass' => MAIL_PASS
    ),

    'logger' => array(
        'name' => 'slim-app',
        'path' => __DIR__ . '/../logs/slim/app.log'
    )
);
