<?php
$app->group('/users', function() use ($app) {


  /*
   * GET
   */
  $app->GET('(/:id)', function($id = null) use ($app) {
    $db = new Lib\Db\Get();

    if ($id) {
      $sql = 'SELECT * FROM `users` WHERE `id` = ?;';
      $values = $id;
      $row = $db->execute($sql, $values);
      print_r($row);
    } else {
      $sql = 'SELECT * FROM `users`;';
      $rows = $db->execute($sql);
      print_r($rows);
    }

    $db->close();
  });


  /*
   * POST
   */
  $app->POST('/', function() use ($app) {
    $db = new Lib\Db\Post;

    $sql = 'INSERT INTO `users` (
      `name`, `email`
    ) VALUES ( ?, ? );';

    $values = array(
      'hanako',
      'hanako@example.com'
    );

    $db->execute($sql, $values);

    $db->close();
  });
});
