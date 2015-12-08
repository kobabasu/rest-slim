<?php
$app->group('/users', function() use ($app) {

  $app->GET('(/:id)', function($id = null) use ($app) {
    $db = new Lib\Db\Get();

    $sql = 'SELECT * FROM `users`';
    $rows = $db->exec($sql);
    print_r($rows);

    $db->close();
  });

  $app->POST('/', function() use ($app) {
    $db = new Lib\Db\Post;

    $sql = 'INSERT INTO `users` (
      `name`, `email`
    ) VALUES ( ?, ? );';

    $params = array(
      'hanako',
      'hanako@example.com'
    );

    $db->exec($sql, $params);

    $db->close();
  });
});
