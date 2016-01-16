<?php
namespace Container;

$c['config'] = function ($c) {
    return array(
        'environment_mode' => ENVIRONMENT_MODE,
        'debug_mode' => DEBUG_MODE
    );
};

$c['config.db'] = function ($c) {
    return array(
        'host' => DB_HOST,
        'name' => DB_NAME,
        'user' => DB_USER,
        'pass' => DB_PASS,
        'port' => DB_PORT
    );
};

$c['config.mail'] = function ($c) {
    return array(
        'host' => MAIL_HOST,
        'port' => MAIL_PORT,
        'user' => MAIL_USER,
        'pass' => MAIL_PASS
    );
};
