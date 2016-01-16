<?php
namespace Routes;

/**
 * root
 */
$app->get(
    '/(:id)',
    function ($id = null) use ($app, $c) {
        echo 'default id:' . $id;
    }
);
