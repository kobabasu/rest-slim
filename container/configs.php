<?php
namespace Container;

$c['config'] = function ($c) {
    $config = array(
        'environment_mode' => ENVIRONMENT_MODE,
        'debug_mode' => DEBUG_MODE
    );
    return $config;
};

$c['config.db'] = function ($c) {
    $config = array(
        'host' => DB_HOST,
        'user' => DB_USER,
        'pass' => DB_PASS,
        'name' => DB_NAME
    );
    return $config;
};

$c['config.mailer'] = function ($c) {
    $config = array(
        'host' => MAIL_HOST,
        'port' => MAIL_PORT,
        'user' => MAIL_USER,
        'pass' => MAIL_PASS,
        'logs' => true
    );
    return $config;
};
