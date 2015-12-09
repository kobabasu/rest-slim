<?php
$app->group('/users', function() use ($app) {

// GET /*{{{*/
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
/*}}}*/

// POST /*{{{*/
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
/*}}}*/

// PUT /*{{{*/
  $app->PUT('/:id', function($id) use ($app) {

    $data = json_decode($app->request->getBody(), true);

    $fields = null;
    $values = array();
    foreach($data as $key => $val) {
      $fields .= $key . '=?,';
      $values[] = $val;
    }

    $sql  = 'UPDATE `users` SET ';
    $sql .= substr($fields, 0, -1);
    $sql .= ' WHERE `id` = ' . $id . ';';

    $db = new Lib\Db\put();
    if ($db->execute($sql, $values)) {
      $sql = 'SELECT * FROM `users` WHERE `id` = ' . $id;
    }
    $db->close();

    $db = new Lib\Db\Get();
    $res = $db->execute($sql);
    $db->close();

    var_dump($res);
  });
/*}}}*/
});

/*
vim:ma:et:nu:ff=unix:fenc=utf-8:ft=php:ts=2:sts=0:sw=2:tw=60:fdm=marker:
 */
