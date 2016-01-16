<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * PDOのシングルトンを実現
 *
 * @package Db
 */
class Connect
{
    /** @var String $host ホスト名 */
    private $host;

    /** @var String $name データベース名 */
    private $name;

    /** @var String $user ユーザ名 */
    private $user;

    /** @var String $pass パスワード */
    private $pass;

    /** @var Integer $port ポート番号 */
    private $port;

    /** @var Boolean $debug デバックの状態 */
    private $debug;

    /**
     * 引数をプロパティに代入
     *
     * @param String $host
     * @param String $name
     * @param String $user
     * @param String $pass
     * @param String $port デフォルトは3306
     * @param Boolean $debug デフォルトはfalse
     * @return object
     * @codeCoverageIgnore
     */
    public function __construct(
        $host,
        $name,
        $user,
        $pass,
        $port = '3306',
        $debug = false
    ) {
        $this->host  = $host;
        $this->name  = $name;
        $this->user  = $user;
        $this->pass  = $pass;
        $this->port  = $port;
        $this->debug = $debug;
    }

    /**
     * PDOを返す
     *
     * @return Object
     */
    public function getConnection()
    {
        $pdo = null;
        try {
            $pdo = new \PDO(
                "mysql:host={$this->host};
                dbname={$this->name};
                charset=utf8;
                ",
                $this->user,
                $this->pass,
                array(
                    \PDO::ATTR_ERRMODE,
                    \PDO::ERRMODE_EXCEPTION
                )
            );

        } catch (\PDOException $e) {
            // @codeCoverageIgnoreStart
            if ($this->debug) {
                var_dump($e->getMessage());
            }
            // @codeCoverageIgnoreEnd
        }

        return $pdo;
    }
}
