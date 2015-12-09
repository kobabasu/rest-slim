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

    var_dump($res);

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

    var_dump($db->getLastInsertId());

    $db->close();
  });
/*}}}*/

// PUT /*{{{*/
  $app->PUT('/:id', function($id) use ($app) {
    $db = new Lib\Db\put();

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

    $res = $db->execute($sql, $values);

    var_dump($res);

    $db->close();
  });
/*}}}*/

// DELETE /*{{{*/
  $app->DELETE('/:id', function($id) use ($app) {
    $db = new Lib\Db\Delete;

    $sql = 'DELETE FROM `users` WHERE `id` = ' . $id;

    $res = $db->execute($sql);

    var_dump($res);
    
    $db->close();
  });
/*}}}*/

});

/*
vim:ma:et:nu:ff=unix:fenc=utf-8:ft=php:ts=2:sts=0:sw=2:tw=60:fdm=marker:
 */
