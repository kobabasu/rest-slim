<?php
$app->group('/users', function() use ($app) {

  $app->GET('(/:id)', function($id = null) use ($app) {

    $sql = 'SELECT * FROM `users`';

    $db = new Lib\Db\Get;
    $rows = $db->exec($sql);
    print_r($rows);
  });

  $app->POST('/', function() use ($app) {

    $sql = 'INSERT INTO `users` (
      `name`, `email`
    ) VALUES ( ?, ? );';

    $params = array(
      'hanako',
      'hanako@example.com'
    );

    $db = new Lib\Db\Post;
    $db->exec($sql, $params);
  });
});
