<?php
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

use \Lib\Db\Connect;
use \Lib\Db\Get;
use \Lib\Db\Post;
use \Lib\Db\Put;
use \Lib\Db\Delete;

use \Lib\SwiftMailer\Init;
use \Lib\SwiftMailer\Mailer;
use \Lib\SwiftMailer\Unit\Twig;

use \Lib\Image\Original;
use \Lib\Image\Thumbnail;

use \Lib\Common\Validate;
use \Lib\Common\Csv;

use \Lib\Pop3\Inbox;
use \Lib\Pop3\Mail;

/**
 * DIC configuration
 */

$container = $app->getContainer();


/**
 * monolog
 */
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];

    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(
        new StreamHandler($settings['path'], Logger::DEBUG)
    );

    return $logger;
};


/**
 * Database
 *
 * [ e.g. ]
 * $db =$this->get('db.get');
 * $sql = 'SELECT * FROM `users` WHERE `id` = ?;';
 * $values = array(1);
 * $res = $db->execute($sql, $values);
 */
$container['db.pdo'] = function ($c) {
    $settings = $c->get('settings')['db'];

    $pdo = new Connect(
        $settings['host'],
        $settings['name'],
        $settings['user'],
        $settings['pass']
    );

    $pdo->setPort($settings['port']);
    $pdo->setCharset($settings['charset']);
    $pdo->setDebug($c->get('settings')['debug_mode']);

    return $pdo->getConnection();
};

// GET
$container['db.get'] = function ($c) {
    $pdo = $c->get('db.pdo');
    $obj = new Get($pdo);
    $obj->setDebug($c->get('settings')['debug_mode']);

    return $obj;
};

// POST
$container['db.post'] = function ($c) {
    $pdo = $c->get('db.pdo');
    $obj = new Post($pdo);
    $obj->setDebug($c->get('settings')['debug_mode']);

    return $obj;
};

// PUT
$container['db.put'] = function ($c) {
    $pdo = $c->get('db.pdo');
    $obj = new Put($pdo);
    $obj->setDebug($c->get('settings')['debug_mode']);

    return $obj;
};

// DELETE
$container['db.delete'] = function ($c) {
    $pdo = $c->get('db.pdo');
    $obj = new Delete($pdo);
    $obj->setDebug($c->get('settings')['debug_mode']);

    return $obj;
};


/**
 * Swift Mailer
 *
 * [ e.g. ]
 * $mailer = $this->get('mailer.text');
 * $twig = $this->get('mailer.twig');
 *
 * // テンプレート内で変数を使う場合は第二引数に
 * // array('name' => 'taro)などを追加する
 * $body = $twig('users.twig');
 *
 * $mailer->setAttachment(
 *     '../upload/' . $filename . '_s.jpg',
 *     'image/jpeg',
 *     $body['name'] . '.jpg'
 * );
 *
 * $mailer->setMessage('title',$body);
 * $res = $mailer->send('info@test.com');
 */
$container['mailer.text'] = function ($c) {
    $settings = $c->get('settings')['mail'];

    $transport = new Init(
        $settings['host'],
        $settings['port'],
        $settings['user'],
        $settings['pass'],
        $settings['fail']
    );

    $mailer = new Mailer($transport);
    $mailer->setFrom($settings['from']);
    $mailer->setName($settings['name']);

    return $mailer;
};

/**
 * Swift Mailer Util/Twig
 * // cacheを利用する場合には
 * // lib/SwiftMailer/Util/Twig.phpの
 * // debugをfalseにする
 *
 * [ e.g. ]
 * $twig = $this->get('mailer.twig');
 *
 * // テンプレート内で変数を使う場合は第二引数に
 * // array('name' => 'taro)などを追加する
 * $body = $twig('users.twig');
 */
$container['mailer.twig'] = function ($c) {
    return new Twig();
};


/**
 * POP3
 * // クラスではなくimap_open関数でPOP3を覗く
 * // mailboxに入っているメールアドレスはすべて
 * // returned mail扱い
 * // swift mailerでreturn-pathを指定すること
 *
 * [ e.g. ]
 * $returns = $this->get('pop3.returns');
 */
$container['pop3.returns'] = function ($c) {
    $settings = $c->get('settings')['pop3'];

    $inbox = new Inbox(
        $settings['host'],
        $settings['user'],
        $settings['pass']
    );

    $ids = $inbox->getIds();
    $mail = new Mail($inbox->get());
    $returns = array();
    $i = 0;

    if (!empty($ids)) {
        foreach ($ids as $id) {
            $returns[] = $mail->getCustomHeader(
                $id,
                'X-Original-To'
            );
            // $mail->del($id);
            $i++;
        }
    }

    // $inbox->expunge();
    $inbox->close();
    return $returns;
};


/**
 * Image
 *
 * [ e.g. ]
 * $fliename = date('Ymd_His');
 * // ファイル名に秒を含めるとずれるためここで確定
 * $original = $this->get('image.original');
 * $original->source($body['canvas']);
 * $original->setFilename($filename);
 * $original->save()
 */
$container['image.original'] = function ($c) {
    $original = new Original();
    $original->setDestination('./');
    $original->setCompress(100);
    $original->setImageType('png');

    return $original;
};

$container['image.thumbnail'] = function ($c) {
    $thumbnail = new Thumbnail();
    $thumbnail->setDestination('./');
    $thumbnail->setPostfix('_s');
    $thumbnail->setCompress(70);
    $thumbnail->setWidth(200);
    $thumbnail->setHeight(200);
    $thumbnail->setImageType('jpg');

    return $thumbnail;
};

/**
 * Common
 *
 * [ e.g. ]
 * $addr = 'failure@dj.pdx.ne.jp';
 * $validate = $this->get('common.validate');
 * $res = $validate->isKetai($addr); // true
 */
$container['common.validate'] = function ($c) {
    return new Validate();
};

/**
 * Common.Csv
 *
 * [ e.g. ]
 * $csv = $this->get('common.csv');
 * $rows = array(array('body1', 'body2'));
 * $csv->body($rows);
 * $csv->save('filename');
 */
$container['common.csv'] = function ($c) {
    $headers = array(
        '個人ID',
        'メールアドレス',
        '名前(姓)',
        '名前(名)',
    );

    $csv = new Csv($headers);
    $csv->setPath('logs/mail/');
    return $csv;
};
