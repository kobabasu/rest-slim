<?php
namespace Routes;

$model = 'users';

/**
 * users
 */
$app->group('/'.$model, function () use ($app, $c) {

    /**
     * GET
     */
    $app->GET(
        '/(:id)',
        function ($id = null) use ($app, $c) {

            $db = $c['db.get'];

            if ($id) {
                $sql  = 'SELECT * FROM `users` ';
                $sql .= 'WHERE `id` = ?;';
                $res = $db->execute($sql, $id);
            } else {
                $sql  = 'SELECT * FROM `users`;';
                $res  = $db->execute($sql);
            }

            $app->RenderJSON($res);
            $db->close();
        }
    );

    /**
     * POST
     */
    $app->POST(
        '/',
        function () use ($app, $c) {

            $db = $c['db.post'];

            $data = json_decode(
                $app->request->getBody(),
                true
            );
            $values = array($data['name'], $data['email']);

            $sql = 'INSERT INTO `users` (
                `name`, `email`
            ) VALUES ( ?, ? );';

            $res = $db->execute($sql, $values);

            $mailer = $c['service.mail.mailer'];

            $body = $mailer->setTemplate(
                'default.twig',
                array('name' => $data['name'])
            );

            $mailer->setMessage(
                'タイトル',
                array('admin@example.com' => '担当'),
                $body
            );

            $mailer->send($data['email']);
            $c['service.mail.transport']->saveLog();

            $app->RenderJSON($db->getLastInsertId());
            $db->close();
        }
    );

    /**
     * PUT
     */
    $app->PUT(
        '/:id',
        function ($id) use ($app, $c) {

            $db = $c['db.put'];

            $data = json_decode(
                $app->request->getBody(),
                true
            );

            $fields = null;
            $values = array();
            foreach ($data as $key => $val) {
                $fields .= $key . '=?,';
                $values[] = $val;
            }

            $sql  = 'UPDATE `users` SET ';
            $sql .= substr($fields, 0, -1);
            $sql .= ' WHERE `id` = ' . $id . ';';

            $res = $db->execute($sql, $values);

            $app->RenderJSON($res);
            $db->close();
        }
    );

    /**
     * DELETE
     */
    $app->DELETE(
        '/:id',
        function ($id) use ($app, $c) {

            $db = $c['db.delete'];

            $sql  = 'DELETE FROM `users` ';
            $sql .= 'WHERE `id` = ' . $id;

            $res = $db->execute($sql);

            $app->RenderJSON($res);

            $db->close();
        }
    );
});
