<?php
namespace Container;

$c['db.pdo'] = function ($c) {
    $cfg = $c['config.db'];

    try {
        $pdo = new \PDO(
            "mysql:host={$c['config.db']['host']};
            dbname={$c['config.db']['name']};
            charset=utf8;
            ",
            $c['config.db']['user'],
            $c['config.db']['pass']
        );

        if ($c['config']['debug_mode']) {
            $pdo->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
        }
    } catch (PDOException $e) {
        if ($c['config']['debug_mode']) {
            echo $e->getMessage();
        }
    }

    return $pdo;
};

$c['db.connection'] = function ($c) {
    $connect = \Lib\Db\Connect::getInstance($c['db.pdo']);
    return $connect;
};
