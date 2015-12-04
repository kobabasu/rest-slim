<?php
$app->group('/users', function() use ($app) {

  $app->get('(/:id)', function($id = null) use ($app) {

    $sql = 'select * from `users`';

    $db = new Lib\Db\Get;
    print_r($db->exec($sql));
  });
});
