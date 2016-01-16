<?php
namespace Container;

use \Lib\Slim\SlimExtends;
use \Lib\SwiftMailer\Init;
use \Lib\SwiftMailer\Mailer;

$c['app'] = function ($c) {
    $app = new SlimExtends();

    $app->response->headers->set(
        'Access-Control-Allow-Origin',
        '*'
    );

    $app->response->headers->set(
        'Content-Type',
        'application/json;charset=utf-8'
    );

    return $app;
};

$c['service.mail.transport'] = function ($c) {
    $cfg = $c['config.mail'];

    return new Init(
        $cfg['host'],
        $cfg['port'],
        $cfg['user'],
        $cfg['pass']
    );
};

$c['service.mail.mailer'] = function ($c) {
    return new Mailer(
        $c['service.mail.transport']
    );
};
