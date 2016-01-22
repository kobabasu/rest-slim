<?php
namespace Container;

use \Lib\Db\Connect;
use \Lib\Db\Get;
use \Lib\Db\Post;
use \Lib\Db\Put;
use \Lib\Db\Delete;

$c['db.connection'] = function ($c) {
    $cfg = $c['config.db'];

    $connect = new Connect(
        $cfg['host'],
        $cfg['name'],
        $cfg['user'],
        $cfg['pass'],
        $cfg['port'],
        $cfg['charset'],
        $c['config']['debug_mode']
    );

    return $connect->getConnection();
};

$c['db.get'] = function ($c) {
    return new Get($c['db.connection']);
};

$c['db.post'] = function ($c) {
    return new Post($c['db.connection']);
};

$c['db.put'] = function ($c) {
    return new Put($c['db.connection']);
};

$c['db.delete'] = function ($c) {
    return new Delete($c['db.connection']);
};
