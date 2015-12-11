<?php
$app->model = 'users';

$app->group('/' . $app->model, function() use ($app) {

// GET /*{{{*/
  $app->GET('/(:id)', function($id = null) use ($app) {
    $db = new Lib\Db\Get();

    if ($id) {
      $sql  = 'SELECT * FROM ' . $app->model;
      $sql .= ' WHERE `id` = ?;';
      $values = $id;
      $res = $db->execute($sql, $values);
    } else {
      $sql  = 'SELECT * FROM ' . $app->model . ';';
      $res  = $db->execute($sql);
    }

    //$app->Render->json($res);

    $mail = new Lib\SwiftMailer\Mailer($app);
    $mail->setSubject('custom subject');
    $mail->send('taro@example.com');

    $db->close();
  });
/*}}}*/

// POST /*{{{*/
  $app->POST('/', function() use ($app) {
    $db = new Lib\Db\Post;

    $data = json_decode($app->request->getBody(), true);

    $sql = 'INSERT INTO ' . $app->model . ' (
      `name`, `email`
    ) VALUES ( ?, ? );';

    $values = array(
      $data['name'],
      $data['email']
    );

    $res = $db->execute($sql, $values);

    $app->Render->json($db->getLastInsertId());

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

    $sql  = 'UPDATE ' . $app->model . ' SET ';
    $sql .= substr($fields, 0, -1);
    $sql .= ' WHERE `id` = ' . $id . ';';

    $res = $db->execute($sql, $values);

    $app->Render->json($res);

    $db->close();
  });
/*}}}*/

// DELETE /*{{{*/
  $app->DELETE('/:id', function($id) use ($app) {
    $db = new Lib\Db\Delete;

    $sql  = 'DELETE FROM ' . $app->model;
    $sql .= ' WHERE `id` = ' . $id;

    $res = $db->execute($sql);

    $app->Render->json($res);
    
    $db->close();
  });
/*}}}*/

});

/*
vim:ma:et:nu:ff=unix:fenc=utf-8:ft=php:ts=2:sts=0:sw=2:tw=60:fdm=marker:
 */
