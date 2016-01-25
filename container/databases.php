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

    $pdo->setDebug($c['config.debug_mode']);
    return $pdo->getConnection();
};

$c['db.get'] = function ($c) {
    $obj = new Get($c['db.pdo']);
    $obj->setDebug($c['config.debug_mode']);
    return $obj;
};

$c['db.post'] = function ($c) {
    $obj = new Post($c['db.pdo']);
    $obj->setDebug($c['config.debug_mode']);
    return $obj;
};

$c['db.put'] = function ($c) {
    $obj = new Put($c['db.pdo']);
    $obj->setDebug($c['config.debug_mode']);
    return $obj;
};

$c['db.delete'] = function ($c) {
    $obj = new Delete($c['db.pdo']);
    $obj->setDebug($c['config.debug_mode']);
    return $obj;
};
