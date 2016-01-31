<?php
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

/**
 * DIC configuration
 */

$container = $app->getContainer();

/**
 * monolog
 */
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];

    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(
        new StreamHandler($settings['path'], Logger::DEBUG)
    );

    return $logger;
};
