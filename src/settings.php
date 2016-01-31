<?php
$withJsonEncOption = (DEBUG) ? JSON_UNESCAPED_UNICODE : 0 ;

return array(
    'jsonEnc' => $withJsonEncOption,

    'settings' => array(
        'displayErrorDetails' => DEBUG
    ),

    'logger' => array(
        'name' => 'slim-app',
        'path' => __DIR__ . '/../logs/slim/app.log'
    )
);
