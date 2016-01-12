<?php
namespace Container;

$c['db.connection'] = function ($c) {
    $cfg = $c['config.db'];

    $connect = new \Lib\Db\Connect(
        $cfg['host'],
        $cfg['name'],
        $cfg['user'],
        $cfg['pass'],
        $cfg['port'],
        $c['config']['debug_mode']
    );

    return $connect->getConnection();
};
