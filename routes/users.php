<?php
$app->group('/users', function() use ($app) {


  /*
   * GET
   */
  $app->GET('/(:id)', function($id = null) use ($app) {
    $db = new Lib\Db\Get();

    if ($id) {
      $sql = 'SELECT * FROM `users` WHERE `id` = ?;';
      $values = $id;
      $res = $db->execute($sql, $values);
    } else {
      $sql = 'SELECT * FROM `users`;';
      $res = $db->execute($sql);
    }

    print_r($res);

    $db->close();
  });


  /*
   * POST
   */
  $app->POST('/', function() use ($app) {
    $db = new Lib\Db\Post;

    $data = json_decode($app->request->getBody(), true);

    $sql = 'INSERT INTO `users` (
      `name`, `email`
    ) VALUES ( ?, ? );';

    $values = array(
      $data['name'],
      $data['email']
    );

    $res = $db->execute($sql, $values);

    print_r($res);

    $db->close();
  });
});
