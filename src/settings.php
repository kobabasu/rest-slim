<?php
if (DEBUG) {
    $withJsonEnc = JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT;
} else {
    $withJsonEnc = 0;
}

return array(
    'settings' => array(
        'displayErrorDetails' => DEBUG,

        'debug_mode'  => DEBUG,
        'environment' => ENVIRONMENT_MODE,
        'withJsonEnc' => $withJsonEnc,

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
    )
);
