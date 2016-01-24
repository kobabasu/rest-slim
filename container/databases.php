<?php
namespace Container;

use \Lib\Db\Connect;
use \Lib\Db\Get;
use \Lib\Db\Post;
use \Lib\Db\Put;
use \Lib\Db\Delete;

$c['db.pdo'] = function ($c) {
    $cfg = $c['config.db'];

    $pdo = new Connect(
        $cfg['host'],
        $cfg['name'],
        $cfg['user'],
        $cfg['pass'],
        $cfg['port'],
        $cfg['charset'],
        $c['config']['debug_mode']
    );

    return $pdo->getConnection();
};

$c['db.get'] = function ($c) {
    return new Get($c['db.pdo']);
};

$c['db.post'] = function ($c) {
    return new Post($c['db.pdo']);
};

$c['db.put'] = function ($c) {
    return new Put($c['db.pdo']);
};

$c['db.delete'] = function ($c) {
    return new Delete($c['db.pdo']);
};
